<?php
session_start();

$products = [];
$message = "";

if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if (!empty($_SESSION['products'])) {
    $products = $_SESSION['products'];
    unset($_SESSION['products']);
} else {

    // 🔥 初期表示は front 側が直接 DB を読む
    require_once "../back/db_connect.php";
    require_once "../back/product_admin_model_only.php";
    // ↑ modelだけ分離して読み込む版を作る

    $model = new ProductModel($pdo);
    $products = $model->getAllProducts();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品検索</title>

    <link rel="stylesheet" href="../css/admin-style.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php require_once __DIR__ . "/header-admin.html"; ?>
<?php require_once __DIR__ . "/list-admin.html"; ?>
<div class="conteiner-header">
    <h2>商品管理</h2>
</div>
<div class="admin-main">
    <div class="conteiner-admin">
        <?php if (!empty($message)) : ?>
            <p style="color: green;"><?= $message ?></p>
        <?php endif; ?>

        <!-- 🔍 検索フォーム -->
        <form action="../back/product_admin.php" method="post" id="edit-form">
            <input type="text" name="keyword" class="input-base-text" placeholder="商品名・説明">
        </form>
        <div class="center">
            <button type="submit" class="btn-base blueBtn" form="edit-form">検索</button>
        </div>
    </div>
    <div class="conteiner-admin">
        <h2>検索結果</h2>

        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $p): ?>
                <div class="product-box">

                    <img src="../image/<?= htmlspecialchars($p['id']); ?>.png"
                         alt="商品画像" class="product-img">

                    <div class="product-info">
                        <p><strong>ID：</strong><?= htmlspecialchars($p['id']) ?></p>
                        <p><strong>商品名：</strong><?= htmlspecialchars($p['name']) ?></p>
                        <p><strong>説明：</strong><?= htmlspecialchars($p['description']) ?></p>
                    </div>

                    <form action="../back/product_admin.php" method="post">
                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                        <input type="hidden" name="action" value="delete">
                    <button type="submit" class="btn-base redBtn">削除</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>商品が見つかりません。</p>
    <?php endif; ?>

</div>
</body>
</html>
