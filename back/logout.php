<?php session_start();?>
<?php require 'header.php';?>
<?php require 'db_connect.php';?>
<?php
 unset($_SESSION['customer']);
    $pdo=new PDO('mysql:host=mysql320.phy.lolipop.lan;dbname=LAA1607635-php;charset=utf8',"LAA1607635","pass1003");
    $sql=$pdo->prepare('select * from customer where login=? and password=?');
    $sql->execute([$_POST['login'],$_POST['password']]);
    
    foreach ($sql as $row){
        $_SESSION['customer']=[
            'id'=> $row['id'],'name'=>$row['name'],'address'=>$row['address'],'login'=>$row['login'],
            'password'=>$row['password']];
    }
    if(isset($_SESSION['customer'])){
        echo 'いらっしゃいませ、',$_SESSION['customer']['name'],'さん。';
    }else{
        echo 'ログイン名またはパスワードが違います';
    }
    ?>
    <?php require './footer.php';?>