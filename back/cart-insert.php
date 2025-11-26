<?php
session_start();
require 'db_connect.php';

// 入力値の検証
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<p>無効な商品IDです。</p>';
    exit;
}

if (!isset($_POST['count']) || !is_numeric($_POST['count']) || $_POST['count'] < 1) {
    echo '<p>無効な数量です。</p>';
    exit;
}

$id = (int)$_GET['id'];

// カートの初期化
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 既存のカート内容を確認
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['item_id'] == $id) {
        $item['count'] += $count;
        $found = true;
        break;
    }
}

// 新規追加
if (!$found) {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $stmt = $pdo->prepare("SELECT * FROM item WHERE item_id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($product) {
            $_SESSION['cart'][] = [
                'item_id' => $id,
                'item_name' => $product['item_name'],
                'price' => $product['price'],
                'img_path' => $product['img_path'],
                'count' => $count
            ];
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'エラーが発生しました';
    }
}

$_SESSION['success'] = 'カートに追加しました';
header('Location: ../front/cart.php');
exit;
?>