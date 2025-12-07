<?php
session_start();
require 'header.html';
?>

<div class="form-container">
    <div class="center-content">
        <h3>出品</h3>
    </div>
    
    <div class="main-layout">
        <!-- enctype="multipart/form-data" を追加 -->
        <form action="../back/product_user.php" method="post" id="edit-form" enctype="multipart/form-data">
            <div class="panels-wrapper">
                <!-- 画像アップロード部分 -->
                <div class="left-panel drag-container">
                    <div class="large-box drop-zone" id="box1">
                        <input type="file" id="fileInput1" name="image" class="file-input" accept="image/*">
                        <i class="fas fa-folder-open fa-2x file-icon"></i>
                        <p>画像を選択</p>
                        <div id="preview"></div>
                    </div>
                </div>

                <!-- 商品情報入力 -->
                <div class="right-panel product-info-form">
                    <h2>商品情報</h2>
                    
                    <div class="form-group">
                        <label>商品名</label>
                        <input type="text" name="unnecessary_items_name" placeholder="商品名" required>
                    </div>
                    
                    <div class="form-group">
                        <label>価格 (円)</label>
                        <input type="number" name="price" placeholder="価格" min="0" required>
                    </div>
                    
                    <div class="form-group">
                        <label>商品説明</label>
                        <textarea name="unnecessary_items_explain" rows="10" placeholder="商品説明" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>サイズ</label>
                        <input type="number" class="min-text" name="width" placeholder="横幅" min="0"><label>cm</label>
                        <input type="number" class="min-text" name="height" placeholder="縦幅" min="0"><label>cm</label>
                    </div>
                    
                    <div class="form-group">
                        <label>ブランド</label>
                        <input type="text" name="brand" placeholder="ブランド名（任意）">
                    </div>
                </div> 
            </div>
            
            <div class="center">
                <div class="btn-group">
                    <a href="javascript:history.back();">
                        <button type="button" class="blueBtn btn-base">戻る</button>
                    </a>
                    <button type="submit" class="btn-base greenBtn">出品する</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// 画像プレビュー機能
document.getElementById('fileInput1').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '<img src="' + event.target.result + '" style="max-width:100%; border-radius:8px; margin-top:10px;">';
        };
        reader.readAsDataURL(file);
    }
});

// ドロップゾーンクリックで選択
document.getElementById('box1').addEventListener('click', function() {
    document.getElementById('fileInput1').click();
});

// ドラッグ&ドロップ機能
const dropZone = document.getElementById('box1');

dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.style.borderColor = '#3498db';
});

dropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.style.borderColor = '';
});

dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    this.style.borderColor = '';
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('fileInput1').files = files;
        const event = new Event('change');
        document.getElementById('fileInput1').dispatchEvent(event);
    }
});
</script>

<?php require 'footer.html'; ?>