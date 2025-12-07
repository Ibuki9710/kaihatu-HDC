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

            <?php
            // 成功・エラーメッセージ表示
            session_start();
            if (!empty($_SESSION['success'])) {
                echo '<p style="color:green;">' . htmlspecialchars($_SESSION['success']) . '</p>';
                unset($_SESSION['success']);
            }
            if (!empty($_SESSION['error'])) {
                echo '<p style="color:red;">' . htmlspecialchars($_SESSION['error']) . '</p>';
                unset($_SESSION['error']);
            }
            ?>

            <form action="../back/product_insert.php" method="post" enctype="multipart/form-data" id="product-form">

                <div class="input-row">
                    <label class="input-label">商品名</label>
                    <div class="input-field-area"> 
                        <input type="text" name="item_name" class="input-base-text" required> 
                    </div>
                </div>

                <div class="input-row">
                    <label class="input-label" for="file-input">商品画像</label>
                    <div class="small-box drop-zone" draggable="true">
                        <input type="file" name="image" id="file-input" class="file-input" required>
                        <i class="fas fa-folder-open fa-2x file-icon"></i>
                    </div>
                </div>

                <div class="input-row">
                    <label class="input-label">商品説明</label>
                    <textarea name="item_explain" class="input-base-text textarea" required></textarea>
                </div>

                <div class="input-row">
                    <label class="input-label">在庫数</label>
                    <input type="number" name="stock" min="0" class="size-input">
                    <input type="checkbox" name="unlimited" id="check" class="checkbox">
                    <label for="check">無制限</label>
                </div>
<div class="input-row">
    <label class="input-label">価格</label>
    <input type="number" name="price" min="0" class="size-input" required>
</div>
                <div class="input-row">
                    <label class="input-label">サイズ登録</label>
                    <div class="size-group">
                        <label>横幅：<input type="number" name="width" min="0" class="size-input"></label>
                        <label>高さ：<input type="number" name="height" min="0" class="size-input"></label>
                    </div>
                </div>

                <div class="input-row">
                    <label class="input-label">公開設定</label>
                    <div class="radio-group">
                        <input type="radio" name="public" value="open" id="open" class="radio" checked>
                        <label for="open">公開</label>
                        <input type="radio" name="public" value="close" id="close" class="radio">
                        <label for="close">非公開</label>
                    </div>
                </div>

                <div class="center">
                    <button type="submit" class="btn-base blueBtn btn-wrapper">商品登録</button>
                </div>
            </form>
        </div>  
    </div>

    <div class="button-row">
        <a href="javascript:history.back();">
            <button class="btn-base blueBtn btn-wrapper">戻る</button>
        </a>
    </div>
</div>

<?php require 'footer-admin.html'; ?>
