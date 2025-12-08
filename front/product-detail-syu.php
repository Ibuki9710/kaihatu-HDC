<?php
require 'header.html';
session_start();
require_once '../back/db_connect.php'; // DB接続

// -----------------------------
// 1. ID取得・バリデーション
// -----------------------------
$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    echo "<p>不正なIDです</p>";
    exit;
}

// -----------------------------
// 2. DBから商品情報取得
// -----------------------------
$sql = $pdo->prepare("SELECT * FROM notitem WHERE unnecessary_items_id = ?");
$sql->execute([$id]);
$item = $sql->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    echo "<p>商品が見つかりません</p>";
    require 'footer.html';
    exit;
}

// -----------------------------
// 3. 画像パス設定
// -----------------------------
$imageFile = !empty($item['image']) ? $item['image'] : 'noimage.png';
$imagePath = "../noimage/" . $imageFile;

// -----------------------------
// 4. 商品情報
// -----------------------------
$name    = $item['unnecessary_items_name'];
$explain = $item['unnecessary_items_explain'];
$width   = $item['width'];
$height  = $item['height'];
$price   = $item['price'];
$brand   = $item['not_brand'] ?? '未設定';
$stock   = "在庫数不明"; // 個人商品のため固定
?>

<div class="product-header-row">
    <div class="product-media-description">
        <div class="product-image-area">
            <p><img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($name) ?>"></p>
        </div>
    </div>

    <div class="product-explanation">
        <h3><?= htmlspecialchars($name) ?></h3>
        <p><?= nl2br(htmlspecialchars($explain)) ?></p>
        <p>ブランド：<?= htmlspecialchars($brand) ?></p>
        <p>在庫数：<?= htmlspecialchars($stock) ?></p>
        <?php if (!empty($width) && !empty($height)): ?>
            <p>横幅：<?= htmlspecialchars($width) ?>cm</p>
            <p>縦幅：<?= htmlspecialchars($height) ?>cm</p>
        <?php endif; ?>
    </div>

    <div class="product-action-box">
        <div class="form-group">
            <form action="../back/cart-insert.php?id=<?= htmlspecialchars($id) ?>" width="50" method="post">
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
</div>
<?php require 'footer.html';?>
