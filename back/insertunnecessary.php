<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare("
    INSERT INTO unnecessary_items
        (unnecessary_items_name, price, unnecessary_items_explain, created_at, width, height, image)
    VALUES
        (?, ?, ?, NOW(), ?, ?, ?)
");

$sql->execute([$name, $price, $explain, $width, $height, $image]);
?>