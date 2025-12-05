<?php require 'db_connect.php'; ?>
<?php
    $sql=$pdo->prepare('select * from item where item_id=?');
    $sql->execute([$_GET['id']]);
    foreach($sql as $row){
        echo '<p><img alt="image" src="../image/', $row['item_id'], '.png"></p>';
        echo '<form action="../back/cart-insert.php?id=', $row['item_id'], '" method="post">';
        echo '<p>', $row['item_name'], '</p>';
        echo '<p>', $row['item_explain'], '</p>';
        echo '<div class="product-action-box">';
        echo '<p>￥', $row['price'], '</p>';
        echo '<p>送料無料</p>';
        echo '<div class="form-group">';
        echo '<label>数量</label><input type="number" name="count" value="1" min="1">';
        echo '</div>';
        echo '<button class="btn-base yellowBtn login-btn" style="width: 100%; margin-top: 15px;">カートに追加</button>';
        echo '</form>';
        echo '</div>';
        echo '<div class="product-full-description" style="max-width: 1200px; margin: 30px auto;">';
        echo '<p>', $row['item_stock'], '</p>';
        echo '<p>', $row['width'], '</p>';
        echo '<p>', $row['height'], '</p>';
        echo '</div>';
        echo '</div>';
    }
?>