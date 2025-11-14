<?php
session_start();
//var_dump($_POST);
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
require 'db_connect.php';

// カートに追加
if (isset($_POST['add_cart'])) {
    $item = [
        'item_id' => $_POST['item_id'],
        'item_name' => $_POST['item_name'],
        'price' => $_POST['price'],
        'img_path' => $_POST['img_path'],
        'quantity' => 1
    ];

    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    $found = false;
    foreach ($_SESSION['cart'] as &$c) {
        if ($c['item_id'] == $item['item_id']) {
            $c['quantity']++;
            $found = true;
            break;
        }
    }

    if (!$found) $_SESSION['cart'][] = $item;

    header('Location: ../front/cart.php');
    exit;
}

// カートから削除
if (isset($_POST['remove'])) {
    foreach ($_SESSION['cart'] as $i => $c) {
        if ($c['item_id'] == $_POST['item_id']) {
            unset($_SESSION['cart'][$i]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header('Location: ../front/cart.php');
    exit;
}
