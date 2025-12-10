<?php
require 'header.html';
?>
<div class="form-container">
    <div class="center-content">
        <h3>出品</h3>
    </div>
    <div class="main-layout">
        <div class="panels-wrapper">
            <div class="left-panel drag-container">
                <div class="large-box" id="box1">
                </div>
            </div>
            <div class="right-panel product-info-form">
                <h2>商品情報</h2>
                <div class="form-group">
                    <label>商品名</label>
                </div>
                <div class="form-group">
                    <label>価格 (円)</label>
                </div>
                <div class="form-group">
                    <label>商品説明</label>
                </div>
                <div class="form-group">
                    <label>商品詳細・追記</label>
                </div>
            </div> 
        </div> 
        <div class="center">
            <a href="javascript:history.back();">
                <button type="submit" class="btn-base blueBtn">戻る</button>
            </a>
        </div>  
    </div>
</div>
<?php require 'footer.html'; ?>