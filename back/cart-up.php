<?php
session_start();
require 'db_connect.php';

// ログインチェック
if (!isset($_SESSION['member_id'])) {
    $_SESSION['error'] = 'ログインしてください';
    header('Location: login.php');
    exit;
}

$member_id = $_SESSION['member_id'];

// カート確認
if (empty($_SESSION['cart'])) {
    $_SESSION['error'] = 'カートが空です';
    header('Location: ../front/cart.php');
    exit;
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO cartss (member_id, item_id, item_amount, total_price) VALUES (?, ?, ?, ?)");

    foreach ($_SESSION['cart'] as $item) {
        $total_price = $item['price'] * $item['count'];
        $stmt->execute([$member_id, $item['item_id'], $item['count'], $total_price]);
    }

    $pdo->commit();

    // カートを空にする
    $_SESSION['cart'] = [];
    $_SESSION['success'] = '注文が完了しました';

    header('Location: ../front/cart-history.php'); // 注文履歴画面へ
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['error'] = '注文処理に失敗しました: ' . $e->getMessage();
    header('Location: ../front/cart.php');
    exit;
}
