<?php 
// このファイルは front/home-sample.php から require されることを想定
// セッションは既に開始されている前提

$keyword = $_POST['keyword'] ?? '';
$height = $_POST['height'] ?? null;
$width = $_POST['width'] ?? null;
$quality = $_POST['quality'] ?? null;
$genre = $_POST['genre'] ?? null;

// 検索条件がある場合のみDB検索
if (!empty($keyword) || !empty($height) || !empty($width) || !empty($quality) || !empty($genre)) {
    require_once 'db_connect.php';
    
    $sql = "SELECT * FROM item WHERE 1=1";
    $params = [];

    // キーワード検索
    if (!empty($keyword)) {
        $sql .= " AND item_name LIKE ?";
        $params[] = '%' . $keyword . '%';
    }

    // サイズ検索（高さ）
    if (!empty($height)) {
        $sql .= " AND height >= ?";
        $params[] = $height;
    }

    // サイズ検索（幅）
    if (!empty($width)) {
        $sql .= " AND width >= ?";
        $params[] = $width;
    }

    // 品質フィルター
    if (!empty($quality)) {
        $sql .= " AND quality = ?";
        $params[] = $quality;
    }

    //ジャンル
    if (!empty($genre)) {
        $sql .= " AND genre = ?";
        $params[] = $genre;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // 検索条件がない場合は全件取得
    require_once 'db_connect.php';
    $sql = $pdo->prepare('SELECT * FROM item');
    $sql->execute();
    $items = $sql->fetchAll(PDO::FETCH_ASSOC);
}

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
