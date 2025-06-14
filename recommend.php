<?php
require 'includes/auth.php';
require 'includes/db.php';

// Gemini API 키 설정
$GEMINI_API_KEY = 'AIzaSyAM-a0EzVwespoNpp68o4mItxcSY2rDAuw'; // ← 여기에 본인의 키 입력

// 사용자 handle 가져오기
$stmt = $conn->prepare("SELECT baekjoon_handle FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($handle);
$stmt->fetch();
$stmt->close();

// 사용자 tier 가져오기
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://solved.ac/api/v3/user/show?handle=$handle");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);
$userTier = $data['tier'] ?? 0;

// 추천 난이도 범위 함수
function getRecommendedTierRange($tier) {
    if ($tier >= 1 && $tier <= 5) return [3, 6];
    if ($tier >= 6 && $tier <= 10) return [6, 10];
    if ($tier >= 11 && $tier <= 15) return [11, 15];
    if ($tier >= 16 && $tier <= 20) return [16, 20];
    if ($tier >= 21 && $tier <= 25) return [21, 25];
    if ($tier >= 26 && $tier <= 30) return [26, 30];
    if ($tier == 31) return [29, 31];
    return [1, 5];
}
list($minTier, $maxTier) = getRecommendedTierRange($userTier);

// 추천 후보 문제 목록 (난이도 기반)
$query = urlencode("tier:$minTier..$maxTier");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://solved.ac/api/v3/search/problem?query=$query&page=1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$problems = json_decode($response, true);

// 후보 문제 배열 정리
$candidateProblems = [];
foreach ($problems['items'] ?? [] as $problem) {
    $candidateProblems[] = [
        'id' => $problem['problemId'],
        'title' => $problem['titleKo'],
        'tier' => $problem['level']
    ];
}

// Gemini에게 보낼 데이터
$payload = [
    'user_tier' => $userTier,
    'candidates' => $candidateProblems
];

$prompt = "다음은 사용자 티어와 그리고 추천 후보 문제 리스트입니다. 
사용자가 아직 풀지 않은 문제 중에서 난이도와 다양성을 고려해 5개의 문제를 추천해주세요. 
결과는 문제 ID만 담긴 JSON 배열로 출력해주세요.";

// Gemini API 호출
$ch = curl_init("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=$GEMINI_API_KEY");
$postFields = json_encode([
    'contents' => [
        [
            'parts' => [
                ['text' => $prompt],
                ['text' => json_encode($payload, JSON_UNESCAPED_UNICODE)]
            ]
        ]
    ]
]);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => $postFields
]);
$response = curl_exec($ch);
curl_close($ch);

// Gemini 응답 처리
$recommendedIds = [];
$result = json_decode($response, true);
if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    $text = $result['candidates'][0]['content']['parts'][0]['text'];
    $parsed = json_decode($text, true);
    if (is_array($parsed)) $recommendedIds = $parsed;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>AI 추천 문제</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="mypage.php">내 solved.ac 정보</a>
    <a href="recommend.php">문제 추천</a>
    <a href="graph">자료구조 시각화</a>
    <a href="logout.php">로그아웃</a>
</nav>

<div class="container">
    <h2><?php echo htmlspecialchars($handle); ?> 님의 AI 추천 문제</h2>
    <p>당신의 티어: <?php echo $userTier; ?> → 추천 난이도: <?php echo "$minTier ~ $maxTier"; ?></p>

    <?php
    $shown = 0;
    foreach ($candidateProblems as $problem) {
        if (in_array($problem['id'], $recommendedIds)) {
            echo "<div class='problem-card'>";
            echo "<a href='https://www.acmicpc.net/problem/{$problem['id']}' target='_blank'>";
            echo "{$problem['id']} : {$problem['title']}</a>";
            echo "</div>";
            $shown++;
        }
    }
    if ($shown === 0) echo "<p>추천할 문제가 없습니다.</p>";
    ?>

    <a href="dashboard.php" class="button">← 대시보드로 돌아가기</a>
</div>
</body>
</html>
