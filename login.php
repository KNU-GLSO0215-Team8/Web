<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "❌ 로그인 실패: 아이디 또는 비밀번호가 틀렸습니다.";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>하루한문제</title>
  <link rel="stylesheet" href="assets/login-style.css">
</head>
<body>

<h1 class="main-title">하루한문제📌</h1>
<div class="container">
    <div class="left">
        <div class="title">하루한문제</div>
        <div class="slogan">
            <p>하루한문제와 함께</p>
            <p>알고리즘 공부!</p>
        </div>
    </div>
    <?php if (isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
    <div class="login-box"> 
        <form method="post">
            <h2>로그인</h2>
            <input type="text" name="username" placeholder="아이디" required>
            <input type="password" name="password" placeholder="비밀번호" required>
            <input type="submit" name="submit" value="로그인">
        </form>
    <a href="register.php" class="button">회원가입!</a>
    </div>
</div>
</body>
</html>
