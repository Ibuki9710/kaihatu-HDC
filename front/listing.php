<?php
require 'header.html';
?>
<div class="form-container">
    <div class="center-content">
        <h3>出品</h3>
    </div>
    <div class="main-layout">
        <form action="../back/product_user.php" method="post" id="edit-form" enctype="multipart/form-data">
            <div class="panels-wrapper">
                <!-- 左パネル：画像アップロード -->
                <div class="left-panel drag-container">
                    <div class="large-box drop-zone" id="box1">
                        <input type="file" id="fileInput1" name="image" class="file-input" accept="image/*">
                        <i class="fas fa-folder-open fa-2x file-icon"></i>
                        <p>画像を選択またはドラッグ&ドロップ</p>
                        <div id="preview"></div>
                    </div>
                </div>

                <!-- 右パネル：商品情報 -->
                <div class="right-panel product-info-form">
                    <h2>商品情報</h2>
                    <div class="form-group">
                        <label>商品名 <span style="color:red;">*</span></label>
                        <input type="text" name="unnecessary_items_name" placeholder="商品名" required>
                    </div>
                    <div class="form-group">
                        <label>価格 (円) <span style="color:red;">*</span></label>
                        <input type="number" name="price" placeholder="価格" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>商品説明 <span style="color:red;">*</span></label>
                        <textarea name="unnecessary_items_explain" rows="6" placeholder="商品説明" required class="textarea"></textarea>
                    </div>
                    <div class="form-group">
                        <label>サイズ</label>
                        <input type="number" name="width" placeholder="横幅(cm)" min="0" class="size">
                        <input type="number" name="height" placeholder="縦幅(cm)" min="0" class="size">
                    </div>
                    <div class="form-group">
                        <label>ブランド <span style="color:red;">*</span></label><br>
                        <label><input type="radio" name="brand" value="大型製品" required> 大型製品</label>
                        <label><input type="radio" name="brand" value="小型製品"> 小型製品</label>
                    </div>
                </div> <!-- right-panel -->
            </div> <!-- panels-wrapper -->

            <div class="center">
                <div class="btn-group">
                    <a href="javascript:history.back();">
                        <button type="button" class="blueBtn btn-base">戻る</button>
                    </a>
                    <button type="submit" class="greenBtn btn-base" form="edit-form">出品</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require 'footer.html'; ?>
