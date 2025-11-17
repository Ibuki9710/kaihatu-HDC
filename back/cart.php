<?php session_start(); ?>
<?php
    echo 'カート一覧';
    if(!empty($_SESSION['cart'])){
        $total=0;
        foreach($_SESSION['cart'] as $id=>$product){
            echo '<img src="', $product['img_path'], '">';
            echo '<h3>', $product['item_name']'</h3>';
            echo '<p>価格　　', $product['price'], '円</p>';
            echo '<p>送料　　無料</p>';
            echo '<p>数量　　', $product['count'], '</p>';
            echo '<a href="#">商品注文画面へ</a>';
        }
    }else{
        echo 'カートに商品がありません。';
    }

    // カートから削除
    if (isset($_POST['remove'])) {
        foreach ($_SESSION['cart'] as $i => $c) {
            if ($c['item_id'] == $_POST['item_id']) {
                unset($_SESSION['cart'][$i]);
                break;
            }
        }
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        header('Location: ../front/cart.php');
        exit;
    }
?>