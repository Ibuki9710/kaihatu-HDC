<?php
session_start();
require 'db_connect.php';

// 入力値の検証
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<p>無効な商品IDです。</p>';
    exit;
}
$id = (int)$_GET['id'];

// カートの初期化
if (!isset($_SESSION['favorite'])) {
    $_SESSION['favorite'] = [];
}

// 既存のカート内容を確認
$found = false;
foreach ($_SESSION['favorite'] as &$favorite) {
    if ($favorite['item_id'] == $id) {
        $found = true;
        break;
    }
}

// 新規追加
if (!$found) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM item WHERE item_id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($product) {
            $_SESSION['favorite'][] = [
                'item_id' => $id,
                'item_name' => $product['item_name'],
                'price' => $product['price'],
                'img_path' => $product['img_path'],
            ];
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'エラーが発生しました';
    }
}

$_SESSION['success'] = 'お気に入りに追加しました';
header('Location: ../front/favorite.php');
exit;
?>