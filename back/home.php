<?php
session_start();

require 'db_connect.php';

// テーブル名が item で合っている場合

$sql = 'SELECT item_id, item_name, price FROM item';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
for($i=1; $i<=20; $i++){
    echo '<img src="../image/', $i, '.png">';
    echo $items[$i-1]['item_name'];
    echo $items[$i-1]['price'], '円';
}

// セッションに保存
$_SESSION['items'] = $items;

// front/home.php にリダイレクト
exit;
?>
