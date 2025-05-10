<?php
$host = 'localhost';
$db   = 'solved_web';
$user = 'webuser';
$pass = 'seo0325';  // 실제 비밀번호로 바꿔야 함

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}
?>
