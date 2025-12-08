<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../back/db_connect.php";

$conditions = [];
$params = [];

// 縦(height)
if (!empty($_POST['height'])) {
    $conditions[] = "height = :height";
    $params[':height'] = (int)$_POST['height'];
}

// 横(width)
if (!empty($_POST['width'])) {
    $conditions[] = "width = :width";
    $params[':width'] = $_POST['width'];
}

// ジャンル1（brand）
if (!empty($_POST['brand'])) {
    $conditions[] = "brand = :brand";
    $params[':brand'] = $_POST['brand'];
}

// ジャンル2（be_solditem）★ここが個人商品フィルター
if (!empty($_POST['be_solditem'])) {
    $conditions[] = "be_solditem = :be_solditem";
    $params[':be_solditem'] = (int)$_POST['be_solditem'];
}

$sql = "SELECT * FROM notitem";

// 条件があれば WHERE 追加
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY unnecessary_items_id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
