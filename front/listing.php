<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>出品フォーム</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <div class="logo" aria-label="チーム立山ロゴ">チーム立山</div>
    <div class="search-box">
      <input type="search" placeholder="検索" aria-label="検索" />
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <circle cx="11" cy="11" r="7"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
      </svg>
    </div>
    <nav>
      <a href="#" title="お知らせ">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 16V9a6 6 0 10-12 0v7l-2 2v1h16v-1l-2-2z"/></svg>
        お知らせ
      </a>
      <a href="#" title="お気に入り">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21l-1-1C5 15 3 12 3 9a6 6 0 1112 0c0 3-2 6-8 11l-1 1z"/></svg>
        お気に入り
      </a>
      <a href="#" title="カート">
        <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 001.99-1.80l1.38-7.20H6"/></svg>
        カート
      </a>
      <a href="#" title="アカウント">
        <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0113 0"/></svg>
        アカウント
      </a>
    </nav>
  </header>

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