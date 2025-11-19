<?php 
    require 'header-admin.html';
    require 'list-admin.html';
?>
<div class="conteiner-header">
    <h2>商品管理</h2>
    <p>商品登録</p>
</div>
<div class="admin-main">
    <div class="conteiner-admin">
        <h3 class="section-title">基本情報</h3>
    </div>

    <div class="conteiner-admin">
        <div class="form-container">
            <form action="" method="post" id="product-form">
                <div class="input-row">
                    <label class="input-label">商品名</label>
                    <div class="input-field-area"> 
                        <input type="text" name="" class="input-field"> 
                    </div>
                </div>

                <div class="input-row">
                    <label class="input-label" for="file-input">商品画像</label>
                    <input type="file" name="product_image" id="file-input" class="hidden-input">
                    <div class="custom-file-drop-area" for="file-input">
                        <i class="fas fa-folder-open fa-2x file-icon"></i>
                    </div>
                </div>
                <label for="file-input" class="label-file">＋ファイルをアップロード</label>  

                <div class="input-row">
                    <label class="input-label">商品名の説明</label>
                    <textarea class="input-field"></textarea>
                </div>
                <div class="input-row">
                    <label class="input-label">在庫数</label>
                    <input type="number" name="stock" min="0" class="size-input">
                    <input type="checkbox" id="check" class="checkbox">
                    <label for="check">無制限</label>
                </div>

                <div class="input-row">
                    <label class="input-label">サイズ登録</label>
                    <div class="size-group">
                        <label>横幅：<input type="number" name="width" min="0" class="size-input"></label>
                        <label>高幅：<input type="number" name="height" min="0" class="size-input"></label>
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
    </div>

    <div class="button-row">
        <a href="search-admin.php">
            <button class="btn-base blueBtn btn-wrapper">戻る</button>
        </a>
    </div>
</div>
<?php require 'footer-admin.html' ?>