<?php
// --- DB接続情報（あなたのロリポップ設定に書き換えてください） ---
$host = "mysql326.phy.lolipop.lan";
$dbname = "LAA1607635-hdc";
$user = "LAA1607635";        // ←ロリポップのDBユーザー名
$pass = "team05";        // ←ロリポップのDBパスワード

// --- DB接続 ---
$conn = new mysqli($host, $user, $pass, $dbname);

// 接続チェック
if ($conn->connect_error) {
    die("DB接続失敗: " . $conn->connect_error);
}

// --- newsテーブルから1件取得 ---
$sql = "SELECT * FROM news LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $title = $row['title'];
    $date = $row['date'];
    $news_id = $row['news_id'];
    $news = $row['news'];
} else {
    $title = "データなし";
    $date = "";
    $news_id = "";
    $news = "";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お知らせ一覧</title>
    <style>
        body {
            font-family: "Hiragino Sans", "Yu Gothic", sans-serif;
            background: #fdfdfd;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 450px;
            margin: 30px auto;
        }
        h2 {
            font-size: 18px;
            margin-bottom: 30px;
            text-align: left;
        }
        .box {
            width: 100%;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 30px;
            text-align: left;
            font-size: 16px;
            box-sizing: border-box;
        }
        .back-btn {
            background: #6ab4e0;
            color: #fff;
            border: none;
            padding: 10px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>お知らせ一覧</h2>

    <div class="box">
    <?= htmlspecialchars($title) ?><br>
    <?= htmlspecialchars($date) ?><br>
    <?= htmlspecialchars($news_id) ?><br>
    <?= nl2br(htmlspecialchars($news)) ?>
    </div>

    <button class="back-btn" onclick="history.back()">戻る</button>
</div>
</body>
</html>
