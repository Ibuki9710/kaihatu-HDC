<?php
session_start();
require 'db_connect.php';

try {
    $pdo = new PDO($connect, USER, PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // itemテーブルから家電商品を取得（在庫があるもの）
    $stmt = $pdo->query('SELECT item_name, price FROM item WHERE item_stock > 0');
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // セッションに保存
    $_SESSION['items'] = $items;

    // home.phpに遷移
    header('Location: ./front/home.php');
    exit;

} catch (PDOException $e) {
    echo "データ取得エラー: " . $e->getMessage();
}

