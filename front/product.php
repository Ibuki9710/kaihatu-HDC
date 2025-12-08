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
            <form action="../back/product_insert.php" method="post" enctype="multipart/form-data" id="product-form">
                
                <!-- 商品名 -->
                <div class="input-row">
                    <label class="input-label">商品名</label>
                    <div class="input-field-area"> 
                        <input type="text" name="item_name" class="input-base-text" required> 
                    </div>
                </div>

                <!-- 価格 -->
                <div class="input-row">
                    <label class="input-label">価格</label>
                    <input type="number" name="price" min="0" class="size-input" required>
                </div>

                <!-- ブランド -->
                <div class="input-row">
                    <label class="input-label">ブランド</label>
                    <select name="brand" required>
                        <option value="">選択してください</option>
                        <option value="大型製品">大型製品</option>
                        <option value="小型製品">小型製品</option>
                    </select>
                </div>

                <!-- 商品画像 -->
                <div class="input-row">
                    <label class="input-label">商品画像</label>
                    <input type="file" name="image" accept="image/*" id="image-input" required>
                    <div style="margin-top:10px;">
                        <img id="image-preview" src="#" alt="画像プレビュー" style="max-width:200px; display:none;">
                    </div>
                </div>

                <!-- 商品説明 -->
                <div class="input-row">
                    <label class="input-label">商品説明</label>
                    <textarea name="item_explain" class="input-base-text textarea"></textarea>
                </div>

                <!-- 在庫 -->
                <div class="input-row">
                    <label class="input-label">在庫数</label>
                    <input type="number" name="item_stock" min="0" class="size-input">
                    <input type="checkbox" id="check" class="checkbox" name="unlimited">
                    <label for="check">無制限</label>
                </div>

                <!-- サイズ -->
                <div class="input-row">
                    <label class="input-label">サイズ登録</label>
                    <div class="size-group">
                        <label>横幅：<input type="number" name="width" min="0" class="size-input"></label>
                        <label>高さ：<input type="number" name="height" min="0" class="size-input"></label>
                        <label>奥行き：<input type="number" name="depth" min="0" class="size-input"></label>
                    </div>
                </div>

                <!-- 公開設定 -->
                <div class="input-row">
                    <label class="input-label">公開設定</label>
                    <div class="radio-group">
                        <input type="radio" name="be_solditem" value="1" id="open" class="radio" checked>
                        <label for="open">公開</label>
                        <input type="radio" name="be_solditem" value="0" id="close" class="radio">
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

<!-- 画像プレビュー用JavaScript -->
<script>
document.getElementById('image-input').addEventListener('change', function(event){
    const file = event.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            const preview = document.getElementById('image-preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});
</script>
