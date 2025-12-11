<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require 'header.html';
require_once __DIR__ . '/../back/db_connect.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お知らせ一覧</title>
    <link rel="stylesheet" href="../css/news.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <div class="center-content">
            <h2>お知らせ一覧</h2>
        </div>
        <?php
        $sql = $pdo->prepare('SELECT * FROM news ORDER BY date DESC');
        $sql->execute();

        echo '<div class="center">';
            while ($news = $sql->fetch(PDO::FETCH_ASSOC)) { ?>
                <!-- タイトル -->
                <a href="news_detail.php?id=<?= htmlspecialchars($news['news_id'], ENT_QUOTES, 'UTF-8'); ?>" class="black">
                    <div class="notification-box">  
                    <!-- 日付 -->
                    <p class="news-date">
                        <?= htmlspecialchars($news['date'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>    
                    <h3><?= htmlspecialchars($news['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <!-- 本文 -->
                        <p class="news-text">
                            <?= nl2br(htmlspecialchars($news['news'], ENT_QUOTES, 'UTF-8')); ?>
                        </p>
                    </div>
                </a>
        <?php } ?>
        </div>
    </div>
 
</body>
</html>
 
<?php
require 'footer.html';
?>