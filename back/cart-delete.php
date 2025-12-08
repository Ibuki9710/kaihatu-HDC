<?php 
session_start();

// IDの検証
if (!isset($_GET['id'])) {
    header('Location: ../front/cart.php');
    exit;
}

// カートから商品を削除
if (isset($_SESSION['cart'][$_GET['id']])) {
    unset($_SESSION['cart'][$_GET['id']]);
    $_SESSION['success'] = '商品を削除しました';
} else {
    $_SESSION['error'] = '商品が見つかりませんでした';
}

// front/cart.phpにリダイレクト
header('Location: ../front/cart.php');
exit;
?>