<?php 
session_start();
require 'header.html';
?>
<div class="form-container">
    <div class="center-content">
        <h2>カート一覧</h2>
    </div>
    <?php require '../back/cart.php'; ?>

    <div class="button-area" style="margin-top:20px;">
        <!-- 戻るボタン -->
        <button type="button" class="btn-back button" onclick="location.href='home-sample.php'">戻る</button>

        <!-- 注文確定ボタン -->
        <form action="../back/order-complete.php" method="post" style="display:inline;">
            <button type="submit" class="btn-order button">注文確定</button>
        </form>
    </div>
</div>
</main>    
</body>
</html>
