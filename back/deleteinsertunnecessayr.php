<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
$id = $_POST['id'];

$sql = $pdo->prepare('DELETE FROM unnecessary_items WHERE unnecessary_items_id = ?');

$sql->execute([$id]);

?>