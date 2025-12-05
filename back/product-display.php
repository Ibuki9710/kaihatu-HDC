<?php 
// このファイルは front/home-sample.php から require されることを想定
// セッションは既に開始されている前提

$keyword = $_POST['keyword'] ?? '';
$height = $_POST['height'] ?? '';
$width = $_POST['width'] ?? '';
$be_solditem = $_POST['be_solditem'] ?? '';
$brand = $_POST['brand'] ?? '';
require_once 'db_connect.php';

$sql = "SELECT * FROM item WHERE 1=1";
$params = [];
// キーワード検索
if ($keyword !== '') {
    $sql .= " AND item_name LIKE ?";
    $params[] = '%' . $keyword . '%';
}

// サイズ検索（高さ）
if ($height !== '' && is_numeric($height)) {
    $sql .= " AND height >= ?";
    $params[] = (int)$height;
}

// サイズ検索（幅）
if ($width !== '' && is_numeric($width)) {
    $sql .= " AND width >= ?";
    $params[] = (int)$width;
}

// 品質フィルター
if (!empty($be_solditem)) {
    $sql .= " AND be_solditem = ?";
    $params[] = $be_solditem;
}

// ジャンル
if (!empty($brand)) {
    $sql .= " AND brand = ?";
    $params[] = $brand;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// HTML出力
if (empty($items)): ?>
    <p>商品データがありません。</p>
<?php else: ?>
    <?php foreach ($items as $item): ?>
    <div class="card">
        <a href="../front/detail.php?id=<?= htmlspecialchars($item['item_id']) ?>" class="black">
            <img src="../image/<?= htmlspecialchars($item['item_id']) ?>.png" alt="<?= htmlspecialchars($item['item_name']) ?>">
            <h3><?= htmlspecialchars($item['item_name']) ?></h3>
            <p>価格: <?= htmlspecialchars($item['price']) ?>円</p>
            <?php if (isset($item['width']) && isset($item['height'])): ?>
                <p><?= htmlspecialchars($item['width']) ?>cm × <?= htmlspecialchars($item['height']) ?>cm</p>
            <?php endif; ?>
        </a>
    </div>
    <?php endforeach; ?>
<?php endif; ?>