<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql = $pdo->query('select * from product order by price desc');
    
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