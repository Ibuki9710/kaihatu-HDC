<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $keyword = $_POST['keyword'];
    $pdo=new PDO($connect, USER, PASS);
    if(isset($keyword)){
        $sql=$pdo->prepare('select * from item where item_name like ?');
        $sql->execute(['%'.$keyword.'%']);
    }else{
        $sql=$pdo->query('select * from item')
    }
    foreach($sql as $row){
        $id=$row['item_id'];
        echo ;
    }
?>