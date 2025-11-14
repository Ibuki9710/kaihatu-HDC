<?php 
session_start();
require 'header.html';
//require '../back/db_connect.php';
require '../back/cart.php';
?>
<div class="form-container">
    <div class="center-content">
        <h1>カート一覧</h1>
    </div>
    --$$-- 一応消す予定 --$$--
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
    --$$-- ここまで --$$--
    <div class="button-area">
        <button class="btn-back button">戻る</button>
        <button class="btn-order button">注文</button>
    </div>
</div>
</main>    
</body>
</html>
