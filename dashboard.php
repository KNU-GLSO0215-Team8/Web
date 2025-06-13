<<<<<<< HEAD


<?php
require 'includes/auth.php';
require 'includes/db.php';
require_once 'includes/config.php';

// 사용자 이름 가져오기
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<nav>
    <a href="<?php echo $URLS['dashboard']; ?>">Dashboard</a>
    <a href="<?php echo $URLS['mypage']; ?>">내 solved.ac 정보</a>
    <a href="<?php echo $URLS['recommand']; ?>">문제 추천</a>
    <a href="<?php echo $URLS['graph']; ?>">자료구조 시각화</a>
    <a href="<?php echo $URLS['logout']; ?>">로그아웃</a>
</nav>

<body>
<div class="container">
    <h2>안녕하세요, <?php echo htmlspecialchars($username); ?>님!</h2>
    <p>아래 메뉴에서 원하는 기능을 선택하세요.</p>

    <a href="<?php echo $URLS['mypage']; ?>">✅ 내 solved.ac 정보 보기</a><br>
    <a href="<?php echo $URLS['recommand']; ?>">🎯 문제 추천 받기</a><br>
    <a href="<?php echo $URLS['logout']; ?>">🚪 로그아웃</a>
</div>
</body>

</html>

=======


<?php
require 'includes/auth.php';
require 'includes/db.php';
require_once 'includes/config.php';

// 사용자 이름 가져오기
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<nav>
    <a href="<?php echo $URLS['dashboard']; ?>">Dashboard</a>
    <a href="<?php echo $URLS['mypage']; ?>">내 solved.ac 정보</a>
    <a href="<?php echo $URLS['recommand']; ?>">문제 추천</a>
    <a href="<?php echo $URLS['graph']; ?>">자료구조 시각화</a>
    <a href="<?php echo $URLS['logout']; ?>">로그아웃</a>
</nav>

<body>
<div class="container">
    <h2>안녕하세요, <?php echo htmlspecialchars($username); ?>님!</h2>
    <p>아래 메뉴에서 원하는 기능을 선택하세요.</p>

    <a href="<?php echo $URLS['mypage']; ?>">✅ 내 solved.ac 정보 보기</a><br>
    <a href="<?php echo $URLS['recommand']; ?>">🎯 문제 추천 받기</a><br>
    <a href="<?php echo $URLS['logout']; ?>">🚪 로그아웃</a>
</div>
</body>

</html>

>>>>>>> 014391d (Add files via upload)
