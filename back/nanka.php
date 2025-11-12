<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql = $pdo->query("select * from product where brand = '大型製品'");

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

<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql = $pdo->query("select * from product where brand = '小型製品'");

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

<?php
    $pdo=new PDO($connect, USER, PASS);
    $height = $_POST['heiht'];
    $width = $_POST['width'];
    $hmax = $height + 50;
    $hsmall = $height - 50;
    $wsmall = $width + 50;
    $wsmall = $width - 50;
    
    if(isset($height,$width)){

    }else if(isset($height)){
        $sql = "SELECT * FROM items WHERE height = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $hsmall<$hmax
        ]);
    }else if(isset($width)){

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

