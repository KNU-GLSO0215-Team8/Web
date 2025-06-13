<?php
require 'includes/auth.php';
require 'includes/db.php';

// 사용자 정보
$stmt = $conn->prepare("SELECT username, baekjoon_handle FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($username, $handle);
$stmt->fetch();
$stmt->close();

// solved.ac User Info
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://solved.ac/api/v3/user/show?handle=$handle");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);
$tier = $data['tier'] ?? 0;
$rating = $data['ratingByProblemsSum'] ?? '알 수 없음';

// Tier Names
$tierNames = [
    0 => "Unrated", 1 => "Bronze V", 2 => "Bronze IV", 3 => "Bronze III",
    4 => "Bronze II", 5 => "Bronze I", 6 => "Silver V", 7 => "Silver IV",
    8 => "Silver III", 9 => "Silver II", 10 => "Silver I", 11 => "Gold V",
    12 => "Gold IV", 13 => "Gold III", 14 => "Gold II", 15 => "Gold I",
    16 => "Platinum V", 17 => "Platinum IV", 18 => "Platinum III",
    19 => "Platinum II", 20 => "Platinum I", 21 => "Diamond V",
    22 => "Diamond IV", 23 => "Diamond III", 24 => "Diamond II",
    25 => "Diamond I", 26 => "Ruby V", 27 => "Ruby IV", 28 => "Ruby III",
    29 => "Ruby II", 30 => "Ruby I", 31 => "Master"
];
// 사용자가 푼 문제 목록
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://solved.ac/api/v3/user/solved_problems?handle=$handle");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$solvedData = json_decode($response, true);
$solvedProblems = array_column($solvedData['items'] ?? [], 'problemId');

// 최근 푼 문제 최대 10개만 추출
$recentProblems = array_slice(array_reverse($solvedProblems), 0, 10);

// 각 문제의 상세 정보 가져오기
$problemDetails = [];
foreach ($recentProblems as $problemId) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://solved.ac/api/v3/problem/show?problemId=$problemId");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $problem = json_decode($response, true);

    if ($problem) {
        $problemDetails[] = [
            'problemId' => $problemId,
            'titleKo' => $problem['titleKo'] ?? '제목 없음',
            'level' => $problem['level'] ?? 0
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>내 solved.ac 정보</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="mypage.php">내 solved.ac 정보</a>
    <a href="recommend.php">문제 추천</a>
    <a href="graph.php">자료구조 시각화</a>
    <a href="logout.php">로그아웃</a>
</nav>
<div class="container">
    <h2><?php echo htmlspecialchars($username); ?> 님의 solved.ac 정보</h2>

    <p><strong>백준 ID:</strong> <?php echo htmlspecialchars($handle); ?></p>
    <p><strong>solved.ac Tier:</strong> <?php echo $tierNames[$tier] ?? '알 수 없음'; ?></p>
    <p><strong>solved.ac Rating:</strong> <?php echo $rating; ?></p>

    <h3>최근 푼 문제 (최대 10개)</h3>
    <?php
    if (count($problemDetails) > 0) {
        foreach ($problemDetails as $problem) {
            echo "<div class='problem-card'>";
            echo "<a href='https://www.acmicpc.net/problem/{$problem['problemId']}' target='_blank'>";
            echo "{$problem['problemId']} : {$problem['titleKo']} ";
            echo "(" . ($tierNames[$problem['level']] ?? 'Unrated') . ")";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "<p>최근 푼 문제가 없습니다.</p>";
    }
    ?>

    <a href="dashboard.php" class="button">← 대시보드로 돌아가기</a>
</div>
</body>
</html>
