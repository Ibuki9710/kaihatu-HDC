<?php session_start(); ?>
<?php require 'db_connect.php'; ?>



<?php
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare("select * from notitem");
    $sql->execute();
    
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo '<h1>出品中</h1>';
    foreach($results as $row){
        $id=$row['item_id'];
        echo '<a href="">';
        echo '<img src="', $row['image'], '">';
        echo $row['unnecessary_items_name'];
        echo $row['width'];
        echo $row['height'];
        echo '</a>';

    }
?>