<?php require 'header.php'; ?>
<br>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>取引詳細</title>
  <link rel="stylesheet" href="torihikisyousai.css" />
</head>
<body>
  

  <main>
    <h1>取引詳細</h1>
    <div class="content-wrapper">
      <section class="image-section">
        <div class="main-image" role="img" aria-label="商品メイン画像"></div>
        <div class="thumbnail-container">
          <div class="thumbnail" role="img" aria-label="サムネイル1"></div>
          <div class="thumbnail" role="img" aria-label="サムネイル2"></div>
          <div class="thumbnail" role="img" aria-label="サムネイル3"></div>
        </div>
        <div class="thumbnail-container">
          <div class="thumbnail" role="img" aria-label="サムネイル4"></div>
          <div class="thumbnail" role="img" aria-label="サムネイル5"></div>
          <div class="thumbnail" role="img" aria-label="サムネイル6"></div>
        </div>
      </section>
      <section class="detail-section">
        <div class="detail-item">商品名</div>
        <div class="detail-item">価格</div>
        <div class="detail-item">商品説明</div>
        <div class="detail-item">商品詳細・追記</div>
        <button class="manage-button">不用品管理画面へ</button>
      </section>
    </div>
  </main>

</body>
</html>
