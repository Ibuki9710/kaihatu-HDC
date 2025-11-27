<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
// DB接続
$pdo = new PDO($connect, USER, PASS);
// IDが渡されているか確認
if (!isset($_POST['id']) || $_POST['id'] === "") {
    echo "<p style='color:red;'>IDが指定されていません。</p>";
    exit();
}

$id = $_POST['id'];

// SQL DELETE 文
$sql = $pdo->prepare("DELETE FROM unnecessary_items WHERE id = ?");
$result = $sql->execute([$id]);

// 成功したら完了画面へリダイレクト
if ($result) {
    header("Location: delete_complete.php");
    exit();
} else {
    echo "<p style='color:red;'>削除に失敗しました。</p>";
}
