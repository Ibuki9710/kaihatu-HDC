<?php
session_start();
require_once 'db_connect.php'; // DB接続

if (!isset($_SESSION['member_id'])) {
    // 未ログインならログインページへ
    header('Location: ../front/login.php');
    exit;
}

$member_id = $_SESSION['member_id'];

try {

    // セッションを破棄してログアウト
    $_SESSION = [];
    session_destroy();

    // ログインページにリダイレクト
    header('Location: /2025/kaihatu-HDC/front/login.php');
    exit;

} catch (PDOException $e) {
    echo "退会処理中にエラーが発生しました: " . htmlspecialchars($e->getMessage());
}
