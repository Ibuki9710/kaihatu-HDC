<?php require 'header.html'; ?>
<br>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>出品フォーム</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  

  <main>
    <h1>出品</h1>
    <div class="image-area">
      <div class="main-image" aria-label="メイン画像">📷</div>
      <div class="thumbnail-row">
        <div class="thumbnail">📷</div>
        <div class="thumbnail">📷</div>
        <div class="thumbnail">📷</div>
      </div>
      <div class="thumbnail-row">
        <div class="thumbnail">📷</div>
        <div class="thumbnail">📷</div>
        <div class="thumbnail">📷</div>
      </div>
    </div>

    <form class="form-area">
      <input type="text" placeholder="商品名" aria-label="商品名" />
      <input type="text" placeholder="価格" aria-label="価格" />
      <textarea placeholder="商品説明" aria-label="商品説明" rows="6"></textarea>
      <textarea placeholder="商品詳細・追記" aria-label="商品詳細・追記" rows="6"></textarea>
      <button type="submit" class="submit-button">出品する</button>
    </form>
  </main>
</body>
</html>