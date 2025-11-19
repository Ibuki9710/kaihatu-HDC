<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: ../front/cart.php');
    exit;
}

// 合計計算
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['count'];
}
$_SESSION['order_total'] = $total;
