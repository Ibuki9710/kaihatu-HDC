<?php 
require 'header-admin.html';
require 'list-admin.html';
?>
<div class="conteiner-header">
    <h2>商品管理</h2>
    <p>商品登録</p>
</div>
<div class="admin-main">
    <form action="#" method="post">
        <div class="form-container">
            <div class="input-row">
                <input type="text" name="" class="customer-text"> 
            </div>
            <div class="center">
                <button type="submit" class="btn-base btn-wrapper blueBtn">
                    検索
                </button>
            </div>
        </div>
    </form>
    <div class="conteiner-admin">
        <h2>検索結果</h2>
    </div>
    <div class="conteiner-admin grey">
        <a href="product-search.php">すべて</a>
        <a href="product-search.php">公開</a>
        <a href="product-search.php">非公開</a>
        <a href="product-search.php">不用品</a>
        <a href="product-search.php">在庫なし</a>
    </div>
    <div class="conteiner-admin">
        <div class="form-container">
        </div>
    </div>
</div>
<?php require 'footer-admin.html'; ?>