<?php 
session_start(); 

// IDが渡されているか確認
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // カートから該当商品を削除
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
        $_SESSION['success'] = 'カートから削除しました';
    }
}

// カートページにリダイレクト
header('Location: ../front/cart.php');
exit;
?>
