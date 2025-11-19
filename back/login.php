<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // ★ 管理者の固定ログイン情報
    $admin_email = "admin@email.com";
    $admin_pass  = "admin";

    // ★ まず管理者ログインを判定
    if ($_POST['email'] === $admin_email && $_POST['password'] === $admin_pass) {

        // 管理者ログイン成功
        $_SESSION['member_id'] = 0; // 管理者なのでIDは何でもOK
        $_SESSION['is_admin'] = true;

        header('Location: ../front/home-admin.php');
        exit;
    }


    try {
        $stmt = $pdo->prepare("SELECT * FROM customer WHERE member_email = ?");
        $stmt->execute([$_POST['email']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['member_id'] = $user['member_id'];
            $admin_emails=['admin@example.com','manager@example.com'];
            //管理者
             if (in_array($_POST['email'], $admin_emails)) {
                $_SESSION['is_admin'] = true;
            header('Location: ../front/home-admin.html');
            exit;
             }
                 $_SESSION['is_admin'] = false;
            header('Location: ../front/home.php');
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
