<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $keyword = $_POST['keyword'];
    $pdo=new PDO($connect, USER, PASS);
    if(isset($keyword)){
        $sql=$pdo->prepare('select * from item where item_name like ?');
        $sql->execute(['%'.$keyword.'%']);
    }else{
        $sql=$pdo->query('select * from item');
    }
    echo '<h1>検索結果1</h1>';
    foreach($sql as $row){
        $id=$row['item_id'];
        echo '<a href="">';
        echo '<img src="', $row['image'], '">';
        echo $row['item_name'];
        echo $row['width'];
        echo $row['height'];
        echo '</a>';
    }
?>