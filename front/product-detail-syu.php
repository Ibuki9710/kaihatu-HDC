<?php
require 'db_connect.php';

$id = $_GET['id'] ?? null;
$notitem = isset($_GET['notitem']) ? intval($_GET['notitem']) : 0;

if (!$id) {
    echo "<p>不正なIDです</p>";
    exit;
}

if ($notitem === 2) {
    $sql = $pdo->prepare("SELECT * FROM notitem WHERE unnecessary_items_id = ?");
    $sql->execute([$id]);
    $item = $sql->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        echo "<p>商品が見つかりません</p>";
        exit;
    }

    $image   = "../noimage/" . ($item['image'] ?? 'noimage.png');
    $name    = $item['unnecessary_items_name'];
    $explain = $item['unnecessary_items_explain'];
    $width   = $item['width'];
    $height  = $item['height'];
    $price   = $item['price'];
    $brand   = $item['not_brand'] ?? '未設定';
    $stock   = "在庫数不明";
} else {
    $sql = $pdo->prepare("SELECT * FROM item WHERE item_id = ?");
    $sql->execute([$id]);
    $item = $sql->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        echo "<p>商品が見つかりません</p>";
        exit;
    }

    $image   = "../image/" . $item['item_id'] . ".png";
    $name    = $item['item_name'];
    $explain = $item['item_explain'];
    $width   = $item['width'];
    $height  = $item['height'];
    $price   = $item['price'];
    $brand   = $item['brand'] ?? '未設定';
    $stock   = $item['item_stock'];
}
?>

<div class="product-header-row">
    <div class="product-media-description">
        <div class="product-image-area">
            <p><img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>"></p>
        </div>
    </div>

    <div class="product-explanation">
        <h3><?= htmlspecialchars($name) ?></h3>
        <p><?= nl2br(htmlspecialchars($explain)) ?></p>
        <p>ブランド：<?= htmlspecialchars($brand) ?></p>
        <p>在庫数：<?= htmlspecialchars($stock) ?></p>
        <?php if ($width && $height): ?>
            <p>横幅：<?= htmlspecialchars($width) ?>cm</p>
            <p>縦幅：<?= htmlspecialchars($height) ?>cm</p>
        <?php endif; ?>
    </div>

    <div class="product-action-box">
        <form action="../back/cart-insert.php?id=<?= urlencode($id) ?>&notitem=<?= $notitem ?>" method="post">
            <p>￥<?= htmlspecialchars($price) ?></p>
            <p>送料無料</p>
            <div class="input-row">
                <label>数量</label>
                <input type="number" name="count" value="1" min="1" class="size">
            </div>
            <div class="center">
                <button class="btn-base yellowBtn black">カートに追加</button>
            </div>
        </form>
    </div>
</div>
