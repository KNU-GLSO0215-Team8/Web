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
    <title>로그인</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h1 class="main-title">하루한문제📌</h1>
<div class="container">
    <h2>로그인</h2>
    <?php if (isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
    <form method="POST">
        <label>아이디</label>
        <input type="text" name="username" required>

        <label>비밀번호</label>
        <input type="password" name="password" required>

        <input type="submit" value="로그인">
    </form>
    <a href="register.php" class="button">회원가입 →</a>
</div>
</body>
</html>
