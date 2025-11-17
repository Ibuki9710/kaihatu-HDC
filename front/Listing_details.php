<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>商品詳細表示</title>
  <link rel="stylesheet" href="listing_details.css" />
</head>
<body>
  <main>
    <div class="left-column">
      <h1>商品詳細</h1>
      <div class="main-image" role="img" aria-label="商品メイン画像">📷</div>
      <div class="thumbnail-row">
        <div class="thumbnail" role="img" aria-label="サムネイル1">📷</div>
        <div class="thumbnail" role="img" aria-label="サムネイル2">📷</div>
        <div class="thumbnail" role="img" aria-label="サムネイル3">📷</div>
      </div>
      <div class="thumbnail-row">
        <div class="thumbnail" role="img" aria-label="サムネイル4">📷</div>
        <div class="thumbnail" role="img" aria-label="サムネイル5">📷</div>
        <div class="thumbnail" role="img" aria-label="サムネイル6">📷</div>
      </div>
    </div>
    <div class="right-column">
      <div class="display-item">
        <strong>商品名</strong>
        
      </div>
      <div class="display-item">
        <strong>価格</strong>
        
      </div>
      <div class="display-item">
        <strong>商品説明</strong>
    
      </div>
      <div class="size-display">
        <strong>サイズ</strong>
        <div>高さ  mm × 横幅  mm</div>
      </div>
      <div class="button-area">
        <button class="btn-delete" type="button">削除</button>
        <button class="btn-back" type="button">戻る</button>
      </div>
    </div>
  </main>
</body>
</html>
