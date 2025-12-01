<?php require 'db-connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from item where id=?');
    $sql->execute([$_GET['id']]);
    foreach($sql as $row){
        echo '<div class="product-header-row">';
        echo '<div class="product-media-description">';
        echo '<div class="product-image-area">';
        echo '<p><img alt="image" src="./image/', $row['id'], '.jpg" class="image"></p>';
        echo '</div>';
        echo '<div class="product-detail-summary">';
        echo '<h2>', $row['item_name'], '</h2>';
        echo '<p>', $row['item_explain'], '</p>';
        echo '<div class="product-action-box">';
        echo '<form action="cart-insert.php?id=', $row['id'], '" method="post">';
        echo '<p>￥', $row['price'], '</p>';
        echo '<p>送料無料</p>';
        echo '<div class="form-group">';
        echo '<label>数量</label><input type="number" name="count">';
        echo '</div>';
        echo '<button class="btn-base yellowBtn login-btn" style="width: 100%; margin-top: 15px;">カートに追加</button>';
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
        echo '</div>';
        echo '</div>';
        echo '<div class="product-full-description" style="max-width: 1200px; margin: 30px auto;">';
        echo '<p>', $row['item_stock'], '</p>';
        echo '<p>', $row['width'], '</p>';
        echo '<p>', $row['height'], '</p>';
        echo '</div>';
        echo '</div>';
    }
?>
