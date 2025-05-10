<?php
require 'includes/auth.php';
require 'includes/db.php';

// 사용자 handle + tier 조회
$stmt = $conn->prepare("SELECT baekjoon_handle FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($handle);
$stmt->fetch();
$stmt->close();

// 사용자 tier
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://solved.ac/api/v3/user/show?handle=$handle");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);
$userTier = $data['tier'] ?? 0;

// 추천 난이도 설정
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

// 사용자 푼 문제 조회
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://solved.ac/api/v3/user/solved_problems?handle=$handle");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$solvedData = json_decode($response, true);
$solvedProblems = array_column($solvedData['items'] ?? [], 'problemId');

// 문제 추천
$query = urlencode("tier:$minTier..$maxTier");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://solved.ac/api/v3/search/problem?query=$query&page=1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$problems = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>추천 문제</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="mypage.php">내 solved.ac 정보</a>
    <a href="recommend.php">문제 추천</a>
    <a href="logout.php">로그아웃</a>
</nav>

<div class="container">
    <h2><?php echo htmlspecialchars($handle); ?> 님의 추천 문제</h2>
    <p>당신의 티어: <?php echo $userTier; ?> → 추천 난이도: <?php echo "$minTier ~ $maxTier"; ?></p>

    <?php
    $recommended = 0;
    foreach ($problems['items'] ?? [] as $problem) {
        if (!in_array($problem['problemId'], $solvedProblems)) {
            echo "<div class='problem-card'>";
            echo "<a href='https://www.acmicpc.net/problem/{$problem['problemId']}' target='_blank'>";
            echo "{$problem['problemId']} : {$problem['titleKo']}</a>";
            echo "</div>";
            $recommended++;
            if ($recommended >= 5) break;
        }
    }
    if ($recommended === 0) echo "<p>추천할 문제가 없습니다.</p>";
    ?>

    <a href="dashboard.php" class="button">← 대시보드로 돌아가기</a>
</div>
</body>
</html>
