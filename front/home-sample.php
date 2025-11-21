<?php 
session_set_cookie_params(['path' => '/']); 
session_start();
$items = $_SESSION['items'] ?? [];
require 'header.html';
require 'list.html';
?>
<div class="main">
<h2>商品一覧</h2>
<?php require '../back/home.php'; ?>
<?php require 'footer.html'; ?>
