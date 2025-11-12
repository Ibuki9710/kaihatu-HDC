<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $stmt = $pdo->prepare("SELECT * FROM customer WHERE member_email = ?");
        $stmt->execute([$_POST['email']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['member_id'] = $user['member_id'];
            header('Location: ../front/customer_menu.php');
            exit;
        } else {
            $_SESSION['login_error'] = 'メールアドレスまたはパスワードが違います';
            header('Location: ../front/login.php');
            exit;
        }

    } catch (PDOException $e) {
        echo "ログインエラー: " . $e->getMessage();
    }
}
