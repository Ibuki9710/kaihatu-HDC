<?php
session_start();
require 'db_connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
} catch (PDOException $e) {
    die("データベース接続エラー: " . $e->getMessage());
}

// ======== POST 取得 ========
$category = $_POST['category'] ?? '';
$quality  = $_POST['quality'] ?? '';
$height   = isset($_POST['height']) ? (int)$_POST['height'] : null;
$width    = isset($_POST['width']) ? (int)$_POST['width'] : null;

// ======== SQL 準備 ========
$where = [];
$params = [];

// ▼ カテゴリー（大型製品 / 小型製品）
if (!empty($category)) {
    $where[] = "brand = ?";
    $params[] = $category;
}

// ▼ 品質（良品 / 並品 / 雑あり）
if (!empty($quality)) {
    $where[] = "quality = ?";
    $params[] = $quality;
}

// ▼ サイズ（縦）
if (!empty($height)) {
    $h_min = max(0, $height - 50);
    $h_max = $height + 50;
    $where[] = "height BETWEEN ? AND ?";
    $params[] = $h_min;
    $params[] = $h_max;
}

// ▼ サイズ（横）
if (!empty($width)) {
    $w_min = max(0, $width - 50);
    $w_max = $width + 50;
    $where[] = "width BETWEEN ? AND ?";
    $params[] = $w_min;
    $params[] = $w_max;
}

// ======== SQL 生成 ========
$sql = "SELECT * FROM product";
if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ======== 表示 ========
echo "<h1>検索結果</h1>";

if ($results) {
    foreach ($results as $row) {
        echo '<div style="margin:10px 0;">';
        echo '<a href="">';
        echo '<img src="'.htmlspecialchars($row['image']).'" style="width:150px;">';
        echo '<br>';
        echo htmlspecialchars($row['item_name']);
        echo '<br>横: '.htmlspecialchars($row['width']).'cm / 縦: '.htmlspecialchars($row['height']).'cm';
        echo '</a>';
        echo '</div>';
    }
} else {
    echo "<p>該当商品は見つかりませんでした。</p>";
}
?>
