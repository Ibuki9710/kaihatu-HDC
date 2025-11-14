<?php
session_start();
require_once 'db_connect.php';

if (!isset($_GET['id'])) {
    header('Location: ../front/home.php');
    exit;
}

try {
    $pdo = new PDO($connect, USER, PASS);
    $stmt = $pdo->prepare("SELECT * FROM items WHERE item_id = ?");
    $stmt->execute([$_GET['id']]);
    $_SESSION['item_detail'] = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "DBエラー: " . $e->getMessage();
}
