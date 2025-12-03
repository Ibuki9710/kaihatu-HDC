<?php 
session_start();
require 'header.html';
?>
<div class="form-container">
    <div class="center-content">
        <h2>カート一覧</h2>
    </div>
    <?php require '../back/cart.php'; ?>
    <div class="button-area">
        <button class="btn-back button" onclick="location.href='home-sample.php'">戻る</button>
        <button class="btn-order button">注文</button>
    </div>
</div>
</main>    
</body>
</html>