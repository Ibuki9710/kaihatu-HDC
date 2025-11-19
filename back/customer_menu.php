<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['member_id'])) {
    header('Location: ../front/login.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM customer WHERE member_id = ?");
    $stmt->execute([$_SESSION['member_id']]);
    $_SESSION['customer_data'] = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "DBエラー: " . $e->getMessage();
}
