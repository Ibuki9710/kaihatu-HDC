<?php session_start(); ?>
<?php
    unset($_SESSION['cart'][$_GET['id']]);
    echo 'カートから商品を削除しました。';
    echo '<hr>';
    require 'cart.php';
?>
