<?php require 'db_connect.php'; ?>
<?php
    $sql=$pdo->prepare('select * from item where item_id=?');
    $sql->execute([$_GET['id']]);
    foreach($sql as $row){
        echo '<div class="product-header-row">';
        echo '<div class="product-media-description">';
        echo '<div class="product-image-area">';
        echo '<p><img alt="image" src="../image/', $row['item_id'], '.png"></p>';
        echo '</div>';
        echo '</div>';
        echo '<div class="product-explanation">';
        echo '<h3>', $row['item_name'], '</h3>';
        echo '<p>', $row['item_explain'], '</p>';
        echo '<p>在庫数：', $row['item_stock'], '</p>';
        echo '<p>横幅：', $row['width'], '</p>';
        echo '<p>縦幅：', $row['height'], '</p>';
        echo '</div>';
        echo '<div class="product-action-box">';
        echo '<div class="form-group">';
        echo '<form action="../back/cart-insert.php?id=', $row['item_id'], '" method="post">';
        echo '<p>￥', $row['price'], '</p>';
        echo '<p>送料無料</p>';
        echo '<div class="input-row">';
        echo '<label>数量</label><input type="number" name="count" value="1" min="1" class="size">';
        echo '</div>';
        echo '<div class="center">';
        echo '<button class="btn-base yellowBtn black">カートに追加</button>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
?>