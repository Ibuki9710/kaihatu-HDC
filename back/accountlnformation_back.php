<?php session_start();
    require 'db_connect.php';
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from customer where customer_id=?');