<?php session_start(); ?>
<?php
    if(!empty($_SESSION['cart'])){
        $total=0;
        foreach($_SESSION['cart'] as $id=>$product){
            echo '<a href="../back/cart-delete.php?id=', $id, '">×</a>';
            echo '<img src="', $product['img_path'], '">';
            echo '<h3>', $product['item_name']'</h3>';
            echo '<p>価格　　', $product['price'], '円</p>';
            echo '<p>送料　　無料</p>';
            echo '<p>数量　　', $product['count'], '</p>';
        }
    }else{
        echo 'カートに商品がありません。';
    }
?>