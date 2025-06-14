<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $handle = $_POST['handle'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, baekjoon_handle) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $handle);

    if ($stmt->execute()) {
        $success = "✅ 회원가입 성공! <a href='login.php'>로그인 하기</a>";
    } else {
        $error = "❌ 에러: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <h2>회원가입</h2>
    <?php
    if (isset($success)) echo "<p style='color:green; text-align:center;'>$success</p>";
    if (isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>";
    ?>
    <form method="POST">
        <label>아이디</label>
        <input type="text" name="username" required>

        <label>비밀번호</label>
        <input type="password" name="password" required>

        <label>백준 ID</label>
        <input type="text" name="handle" required>

        <input type="submit" value="회원가입">
    </form>
    <a href="login.php" class="button">← 로그인 페이지로</a>
</div>
</body>
</html>
