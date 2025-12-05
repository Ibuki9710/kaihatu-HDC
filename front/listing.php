<?php
require 'header.html';
?>
<div class="form-container">
    <div class="center-content">
        <h3>出品</h3>
    </div>
    <div class="main-layout">
        <form action="#" method="post" id="edit-form">
            <div class="panels-wrapper">
                <div class="left-panel drag-container">
                    <div class="large-box drop-zone" id="box1" draggable="true">
                        <input type="file" id="fileInput1" class="file-input" multiple>
                        <i class="fas fa-folder-open fa-2x file-icon"></i>
                    </div>
                    </div>
                    <p class="drop-text">ドロップまたはクリック</p>
                </div>

                <div class="right-panel product-info-form">
                    <h2>商品情報</h2>
                    <div class="form-group">
                        <label>商品名</label>
                        <input type="text" name="" placeholder="商品名">
                    </div>
                    <div class="form-group">
                        <label>価格 (円)</label>
                        <input type="number" name="" placeholder="価格">
                    </div>
                    <div class="form-group">
                        <label>商品説明</label>
                        <textarea name="" rows="10" placeholder="商品説明" class="textarea"></textarea>
                    </div>
                    <div class="form-group">
                        <label>サイズ</label>
                        <input type="number" class="min-text" name="" placeholder="横幅"><label>cm</label>
                        <input type="number" class="min-text" name="" placeholder="縦幅"><label>cm</label>
                    </div>
                </div> 
            </div>   
        </form>
        <div class="center">
            <div class="btn-group">
                <a href="javascript:history.back();">
                    <button class="blueBtn btn-base">戻る</button>
                </a>
            <button type="submit" class="btn-base greenBtn" form="edit-form">出品</button>
        </div>
    </div>
</div>
<?php require 'footer.html'; ?>