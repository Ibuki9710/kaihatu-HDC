<?php 
session_start();
require 'hedder.php';
require_once '../back/cart.php';
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

<header>
    <div class="logo" aria-label="チーム立山">チーム立山</div>
    <div class="search-box">
        <input type="search" placeholder="検索" aria-label="検索" />
        <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="11" cy="11" r="7" />
            <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
    </div>
    
</header>

<h1>カート一覧</h1>

<div class="cart-list">
    <section class="cart-item">
        <button class="remove-btn" aria-label="商品を削除">×</button>
        <img src="https://cdn.pixabay.com/photo/2016/06/14/08/31/refrigerator-1453513_1280.jpg" alt="冷蔵庫" />
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
