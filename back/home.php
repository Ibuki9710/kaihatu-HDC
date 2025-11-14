<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_set_cookie_params(['path' => '/']); 
session_start();

require_once 'db_connect.php';

// テーブル名が item で合っている場合
$sql = "SELECT * FROM item"; 
$stmt = $pdo->prepare($sql);
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// セッションに保存
$_SESSION['items'] = $items;

// front/home.php にリダイレクト
header('Location: ../front/home.php');
exit;
