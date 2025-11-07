<?php
session_set_cookie_params(['path' => '/']); 
session_start();
require 'db_connect.php';

try {
    $pdo = new PDO($connect, USER, PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $stmt = $pdo->query('SELECT item_id, item_name, price, image FROM item WHERE item_stock > 0');
    $_SESSION['items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Location: ../front/home.php');
    exit;

} catch (PDOException $e) {
    echo "データ取得エラー: " . $e->getMessage();
}
