<?php session_start(); ?>
<?php
    unset($_SESSION['cart'][$_GET['id']]);
    require 'cart.php';
?>
