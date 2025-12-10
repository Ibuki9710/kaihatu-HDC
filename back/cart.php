<?php session_start(); ?>
<?php
    if(!empty($_SESSION['cart'])){
        $total=0;
        echo '<div class="cart-list">';
        foreach($_SESSION['cart'] as $id=>$product){
            echo '<section class="cart-item">';
            echo '<a href="../back/cart-delete.php?id=', $id, '" class="remove-btn">×</a>';
            echo '<img src="../image/', $product['item_id'], '.png">';
            echo '<div class="info">';
            echo '<h3>', $product['item_name'], '</h3>';
            echo '<p>価格　　', $product['price'], '円</p>';
            echo '<p>送料　　無料</p>';
            echo '<p>数量　　', $product['count'], '</p>';
            echo '</div>';
            echo '</section>';
        }
        echo '</div>';
    }else{
        echo 'カートに商品がありません。';
    }
?>