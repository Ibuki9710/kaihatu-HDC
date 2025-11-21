<?php session_start();
require '../back/db_connect.php';
?>
<?php require 'header.html'; ?>
<div class="center">
    <div class="form-container">
        <div class="center-content">
            <h2 class="h2">お知らせ</h2>
        </div>
        <?php
        $sql=$pdo->prepare('SELECT * FROM news');
        $sql->execute();
        while($news=$sql->fetch(PDO::FETCH_ASSOC)){ ?>
        <div class="news-item">
            <div class="news-date"><?php echo htmlspecialchars($news['news_date'], ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="news-title"><?php echo htmlspecialchars($news['news_title'], ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="news-content"><?php echo nl2br(htmlspecialchars($news['news_content'], ENT_QUOTES, 'UTF-8')); }?> 
        </div>
        </div>
        
<?php require 'footer.html'; ?>

      
        