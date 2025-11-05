<?php session_start(); ?>
<?php require './front/header.php';?>
<?php require 'db_connect.php';?>
    <?php
    unset($_SESSION['customer']);
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select * from news ');
    $sql->execute([$_POST['news']]);
    $sql->execute([$_POST['news']]);
    foreach ($sql as $row){
        
    }

?>
<?php require './front/footer.php'; ?>
