<?php
// 기본 BASE URL 설정
$BASE_URL = "http://34.22.99.197/solved_web/";

// 개별 페이지 경로 (선택적으로 분리 가능)
$URLS = [
  'dashboard' => $BASE_URL . "/dashboard.php",
  'graph' => $BASE_URL . "/graph.php",
  'mypage' => $BASE_URL . "/mypage.php",
  'recommend' => $BASE_URL . "/recommend.php",
  'pseudocode' => $BASE_URL . "/pseudocode.php",
  'logout' => $BASE_URL . "/logout.php",
  'login' => $BASE_URL . "/login.php",
  'register' => $BASE_URL . "/register.php"
];
?>