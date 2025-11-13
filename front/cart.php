<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cart.css">
    <title>cart.php</title>
    
</head>
<body>
    <h1>カート一覧</h1>

    
</header>

<h1>カート一覧</h1>

<div class="cart-list">
    <section class="cart-item">
        <button class="remove-btn" aria-label="商品を削除">×</button>
        <img src="../image/1.png" alt="冷蔵庫" />
        <div class="info">
            <strong>冷蔵庫</strong>
            <div>販売元</div>
            <div>価格　5900円</div>
            <div>送料　無料</div>
            <div>数量</div>
            <a href="#" class="order-link">商品注文画面へ</a>
        </div>
    </section>

    <section class="cart-item">
        <button class="remove-btn" aria-label="商品を削除">×</button>
        <div class="info">
            <strong>商品名</strong>
            <div>販売元</div>
            <div>価格</div>
            <div>送料</div>
            <div>数量</div>
            <a href="#" class="order-link">商品注文画面へ</a>
        </div>
    </section>

    <section class="cart-item">
        <button class="remove-btn" aria-label="商品を削除">×</button>
        <div class="info">
            <strong>商品名</strong>
            <div>販売元</div>
            <div>価格</div>
            <div>送料</div>
            <div>数量</div>
            <a href="#" class="order-link">商品注文画面へ</a>
        </div>
    </section>
</div>
<div class="button-area">
    <button class="btn-back">戻る</button>
    <button class="btn-order">注文</button>
</div>

</body>
</html>
