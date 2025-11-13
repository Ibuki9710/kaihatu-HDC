<?php 
    require 'header-admin.html';
    require 'list-admin.html';
?>
<div class="conteiner-header">
    <h2>商品管理</h2>
</div>
<div class="admin-main">
    <div class="conteiner-admin">
        <p class="section-title">基本情報</p>
    </div>

    <div class="conteiner-admin">
        <form action="" method="post" id="product-form">
            <div class="input-row">
                <label class="input-label" for="product-name">商品名</label>
                <div class="input-field-area"> 
                    <input type="text" name="" id="product-name" class="input-field"> 
                </div>
            </div>

            <div class="input-row">
                <label class="input-label" for="file-input">商品画像</label>
                <input type="file" name="product_image" id="file-input" class="hidden-input">
                <div class="custom-file-drop-area" for="file-input">
                    <i class="fas fa-folder-open fa-2x file-icon"></i>
                </div>
            </div>
            <label for="label-file">＋ファイルをアップロード</label>  

            <div class="input-row">
                <label class="input-label" for="product-description">商品名の説明</label>
                <textarea id="product-description" class="input-field"></textarea>
            </div>
            <div class="input-row">
                <label class="input-label" for="stock">在庫数</label>
                <input type="number" name="stock" id="stock" min="0" class="input-field-small">
                <input type="checkbox" name="unlimited_stock" id="check" class="checkbox">
                <label for="check">無制限</label>
            </div>

            <div class="input-row">
                <label class="input-label">サイズ登録</label>
                <div class="size-group">
                    <label>横幅：<input type="number" name="width" min="0" class="mintext-input"></label>
                    <label>高幅：<input type="number" name="height" min="0" class="mintext-input"></label>
                </div>
            </div>
            
            <div class="input-row">
                <label class="input-label">公開設定</label>
                <div class="radio-group">
                    <input type="radio" name="public" id="open" class="radio">
                    <label for="open">公開</label>
                    <input type="radio" name="public" id="close" class="radio">
                    <label for="close">非公開</label>
                </div>
            </div>

            <div class="center">
                <button type="submit" class="btn-base blueBtn btn-wapper">商品登録</button>
            </div>
        </form>
    </div>

    <div class="button-row">
        <a href="search-admin.php">
            <button class="btn-base greyBtn">検索画面に戻る</button>
        </a>
    </div>
</div>