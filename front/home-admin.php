<?php 
require 'header-admin.html';
require 'list-admin.html'; 

require_once __DIR__ . '/../back/db_connect.php';
?>

<div class="conteiner-header">
    <h2>ホーム</h2>
</div>

<div class="admin-main">
    <div class="conteiner-admin">
        <p>お知らせ一覧</p>
    </div>
    <div class="conteiner-admin">
        <?php
    
        $sql = $pdo->prepare('SELECT * FROM news ORDER BY date DESC');
        $sql->execute();

        while ($news = $sql->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="blue container">

                <p class="news-title">
                        <?= htmlspecialchars($news['title'], ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <p class="news-date">
                    <?= htmlspecialchars($news['date'], ENT_QUOTES, 'UTF-8'); ?>
                    　
                    <?= mb_strimwidth(htmlspecialchars($news['news'], ENT_QUOTES, 'UTF-8'), 0, 80, '…'); ?>
                </p>
            </div>
        <?php } ?>
    </div>
</div>

<?php require 'footer-admin.html'; ?>
