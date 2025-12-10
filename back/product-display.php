<?php 
require_once 'db_connect.php';

$notitem = isset($_POST['notitem']) ? intval($_POST['notitem']) : 0; // 2:個人
$keyword = $_POST['keyword'] ?? '';
$height = $_POST['height'] ?? '';
$width = $_POST['width'] ?? '';
$brand = $_POST['brand'] ?? '';

$items = [];

if ($notitem === 2) {
    $sql = "SELECT * FROM item WHERE 1=1";
    $params = [];

    if ($keyword !== '') {
        $sql .= " AND unnecessary_items_name LIKE ?";
        $params[] = '%' . $keyword . '%';
    }
    if ($height !== '' && is_numeric($height)) {
        $sql .= " AND height >= ?";
        $params[] = (int)$height;
    }
    if ($width !== '' && is_numeric($width)) {
        $sql .= " AND width >= ?";
        $params[] = (int)$width;
    }
    if ($brand !== '') {
        $sql .= " AND not_brand = ?";
        $params[] = $brand;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT * FROM item WHERE 1=1";
    $params = [];

    if ($keyword !== '') {
        $sql .= " AND item_name LIKE ?";
        $params[] = '%' . $keyword . '%';
    }
    if ($height !== '' && is_numeric($height)) {
        $sql .= " AND height >= ?";
        $params[] = (int)$height;
    }
    if ($width !== '' && is_numeric($width)) {
        $sql .= " AND width >= ?";
        $params[] = (int)$width;
    }
    if ($brand !== '') {
        $sql .= " AND brand = ?";
        $params[] = $brand;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// 出力
if (empty($items)) {
    echo "<p>商品データがありません。</p>";
} else {
    foreach ($items as $item) {
        // notitemによって分岐（unnecessary_items_idまたはitem_idを使用）
        if ($notitem === 2) {
            $detailLink = '../front/product-detail-syu.php?id=' . htmlspecialchars($item['unnecessary_items_id']);
            $itemId = $item['unnecessary_items_id'];
        } else {
            $detailLink = '../front/detail.php?id=' . htmlspecialchars($item['item_id']);
            $itemId = $item['item_id'];
        }

        // 画像パス: すべて../image/フォルダからitem_id.png形式で取得
        $imagePath = '../image/' . htmlspecialchars($itemId) . '.png';

        $name = $item['unnecessary_items_name'] ?? $item['item_name'];
        $price = $item['price'];
        $width = $item['width'] ?? '';
        $height = $item['height'] ?? '';
        ?>

        <div class="card">
            <a href="<?= $detailLink ?>" class="black">
                <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($name) ?>">
                <h3><?= htmlspecialchars($name) ?></h3>
                <p>価格: <?= htmlspecialchars($price) ?>円</p>
                <?php if ($width && $height): ?>
                    <p><?= htmlspecialchars($width) ?>cm × <?= htmlspecialchars($height) ?>cm</p>
                <?php endif; ?>
            </a>
        </div>
    <?php }
}
?>