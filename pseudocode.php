<<<<<<< HEAD
<?php
require 'includes/auth.php';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>알고리즘 수도코드 작성기</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .pseudocode-container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        textarea {
            width: 100%;
            height: 400px;
            font-family: Consolas, monospace;
            font-size: 14px;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            resize: vertical;
        }

        button {
            margin-top: 15px;
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 8px;
            font-size: 14px;
        }

        button:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
<nav>
    <a href="<?php echo $URLS['dashboard']; ?>">Dashboard</a>
    <a href="mypage">내 solved.ac 정보</a>
    <a href="recommand">문제 추천</a>
    <a href="graph">자료구조 시각화</a>
    <a href="<?php echo $URLS['logout']; ?>">로그아웃</a>
</nav>

<div class="pseudocode-container">
    <h2>알고리즘 수도코드 작성기</h2>
    <textarea id="pseudocode" placeholder="여기에 알고리즘 수도코드를 작성하세요..."></textarea>
    <button onclick="copyCode()">복사하기</button>
</div>

<script>
function copyCode() {
    const textarea = document.getElementById("pseudocode");
    textarea.select();
    document.execCommand("copy");
    alert("수도코드가 클립보드에 복사되었습니다!");
}
</script>
</body>
</html>
=======
<?php
require 'includes/auth.php';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>알고리즘 수도코드 작성기</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .pseudocode-container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        textarea {
            width: 100%;
            height: 400px;
            font-family: Consolas, monospace;
            font-size: 14px;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            resize: vertical;
        }

        button {
            margin-top: 15px;
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 8px;
            font-size: 14px;
        }

        button:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
<nav>
    <a href="<?php echo $URLS['dashboard']; ?>">Dashboard</a>
    <a href="mypage">내 solved.ac 정보</a>
    <a href="recommand">문제 추천</a>
    <a href="graph">자료구조 시각화</a>
    <a href="<?php echo $URLS['logout']; ?>">로그아웃</a>
</nav>

<div class="pseudocode-container">
    <h2>알고리즘 수도코드 작성기</h2>
    <textarea id="pseudocode" placeholder="여기에 알고리즘 수도코드를 작성하세요..."></textarea>
    <button onclick="copyCode()">복사하기</button>
</div>

<script>
function copyCode() {
    const textarea = document.getElementById("pseudocode");
    textarea.select();
    document.execCommand("copy");
    alert("수도코드가 클립보드에 복사되었습니다!");
}
</script>
</body>
</html>
>>>>>>> 014391d (Add files via upload)
