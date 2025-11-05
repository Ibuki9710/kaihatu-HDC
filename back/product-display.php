<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $keyword = $_POST['keyword'];
    $pdo=new PDO($connect, USER, PASS);
    if(isset($keyword)){
        $sql=$pdo->prepare('select image from item where item_name like ?');
        $sql->execute(['%'.$keyword.'%']);
    }else{
        $sql=$pdo->query('select image from item');
    }
    echo '<h1>検索結果1</h1>';
    foreach($sql as $row){
        $id=$row['item_id'];
        echo $row['image'];
        echo $row['width'];
        echo $row['height'];
    }
?>