<?php
$handle = "tourist";  // solved.ac 유저 핸들
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://solved.ac/api/v3/user/show?handle=$handle");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);

echo "solved.ac 유저 tourist의 tier: " . $data['tier'];
?>
