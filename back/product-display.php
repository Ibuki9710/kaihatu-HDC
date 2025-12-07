<?php
require_once 'db_connect.php';

$keyword = $_POST['keyword'] ?? '';
$height  = $_POST['height'] ?? '';
$width   = $_POST['width'] ?? '';
$notitem = isset($_POST['notitem']) ? intval($_POST['notitem']) : 0; // 1:公式, 2:個人
$brand   = $_POST['brand'] ?? '';

$items = [];

if ($notitem === 2) {
    $sql = "SELECT * FROM notitem WHERE 1=1";
    $params = [];

    if ($keyword !== '') { $sql .= " AND unnecessary_items_name LIKE ?"; $params[] = "%$keyword%"; }
    if ($height !== '' && is_numeric($height)) { $sql .= " AND height >= ?"; $params[] = (int)$height; }
    if ($width !== '' && is_numeric($width)) { $sql .= " AND width >= ?"; $params[] = (int)$width; }
    if ($brand !== '') { $sql .= " AND not_brand = ?"; $params[] = $brand; }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT * FROM item WHERE 1=1";
    $params = [];

    if ($keyword !== '') { $sql .= " AND item_name LIKE ?"; $params[] = "%$keyword%"; }
    if ($height !== '' && is_numeric($height)) { $sql .= " AND height >= ?"; $params[] = (int)$height; }
    if ($width !== '' && is_numeric($width)) { $sql .= " AND width >= ?"; $params[] = (int)$width; }
    if ($brand !== '') { $sql .= " AND brand = ?"; $params[] = $brand; }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php if (empty($items)): ?>
    <p>商品データがありません。</p>
<?php else: ?>
    <?php foreach ($items as $item): ?>
        <?php
            $isNotItem = $notitem === 2;
            $id        = $isNotItem ? $item['unnecessary_items_id'] : $item['item_id'];
            $detailLink = $isNotItem 
                ? "../front/product-detail-syu.php?id={$id}&& notitem=2"
                : "../front/detail.php?id={$id}";
            $imagePath = $isNotItem
                ? "../noimage/" . ($item['image'] ?? 'noimage.png')
                : "../image/{$item['item_id']}.png";
        ?>
        <div class="card">
            <a href="<?= $detailLink ?>" class="black">
                <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($item['unnecessary_items_name'] ?? $item['item_name']) ?>">
                <h3><?= htmlspecialchars($item['unnecessary_items_name'] ?? $item['item_name']) ?></h3>
                <p>価格: <?= htmlspecialchars($item['price']) ?>円</p>
                <?php if (!empty($item['width']) && !empty($item['height'])): ?>
                    <p><?= htmlspecialchars($item['width']) ?>cm × <?= htmlspecialchars($item['height']) ?>cm</p>
                <?php endif; ?>
            </a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
