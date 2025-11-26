<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['customer_id'])) {
    header('Location: ../front/login.php');
    exit;
}

try {
    $pdo = new PDO($connect, USER, PASS);
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_id = ?");
    $stmt->execute([$_SESSION['customer_id']]);
    $_SESSION['order_history'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "DBエラー: " . $e->getMessage();
}
