<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $stmt = $pdo->prepare("INSERT INTO customer(name, member_email, password) VALUES(?, ?, ?)");
        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        $_SESSION['register_success'] = true;
        header('Location: ../front/customer_output.php');
        exit;

    } catch (PDOException $e) {
        echo "登録エラー: " . $e->getMessage();
    }
}
