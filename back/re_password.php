<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $stmt = $pdo->prepare("UPDATE customers SET password = ? WHERE email = ?");
        $stmt->execute([
            password_hash($_POST['new_password'], PASSWORD_DEFAULT),
            $_POST['email']
        ]);
        $_SESSION['password_reset'] = true;
        header('Location: ../frontend/login.php');
        exit;

    } catch (PDOException $e) {
        echo "パスワード再設定エラー: " . $e->getMessage();
    }
}
