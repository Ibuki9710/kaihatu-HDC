<?php
session_start();
require_once 'db_connect.php';

try {
    $pdo = new PDO($connect, USER, PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $stmt = $pdo->query("SELECT * FROM items ORDER BY created_at DESC LIMIT 20");
    $_SESSION['home_items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "DBエラー: " . $e->getMessage();
    exit;
}
