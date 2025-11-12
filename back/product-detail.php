<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from item where id=?');
    $sql->execute([$_GET['id']]);
    foreach($sql as $row){
        echo '<p><img alt="image" src="./image/', $row['id'], '.jpg"></p>';
        echo '<form action="cart-insert.php?id=', $row['id'], '" method="post">';
        echo '<p>', $row['item_name'], '</p>';
        echo '<p>', $row['item_explain'], '</p>';
        echo '<p>￥', $row['price'], '</p>';
        echo '<p>送料無料</p>';
        echo '数量<input type="number" name="count">';
        echo '<p><input type="submit" value="カートに追加"></p>';
        echo '<p>', $row['item_stock'], '</p>';
        echo '<p>', $row['width'], '</p>';
        echo '<p>', $row['height'], '</p>';
        echo '<input type="hidden" name="id" value="', $row['item_id'], '">';
        echo '<input type="hidden" name="name" value="', $row['item_name'], '">';
        echo '<input type="hidden" name="price" value="', $row['price'], '">';
        echo '<input type="hidden" name="genre" value="', $row['genre'], '">';
        echo '<input type="hidden" name="width" value="', $row['width'], '">';
        echo '<input type="hidden" name="height" value="', $row['height'], '">';
        echo '<input type="hidden" name="be_solditem" value="', $row['be_solditem'], '">';
        echo '<input type="hidden" name="item_explain" value="', $row['item_explain'], '">';
        echo '<input type="hidden" name="brand" value="', $row['brand'], '">';
        echo '</form>';
    }
?>
