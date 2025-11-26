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
                <input type="text" name="" class="input-base-text" placeholder="商品"> 
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
    <div class="conteiner-admin">
        <a href="product-search.php" class="black">すべて</a>
        <a href="product-search.php" class="black">公開</a>
        <a href="product-search.php" class="black">非公開</a>
        <a href="product-search.php" class="black">不用品</a>
        <a href="product-search.php" class="black">在庫なし</a>
    </div>
    <div class="conteiner-admin">
        <div class="conteiner-admin grey">
        </div>
    </div>
</div>
<?php require 'footer-admin.html'; ?>