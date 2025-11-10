<?php 
session_start();
require 'back/db_connect.php';
if (empty($_SESSION['cart'])) {
    $cart_items = [];
} else {
    $ids = array_column($_SESSION['cart'], 'item_id');
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "SELECT * FROM items WHERE id IN ($placeholders)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($ids);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cart.css">
    <title>cart.php</title>
    
</head>
<body>
    
    
</header>

<h1>カート一覧</h1>

<div class="cart-list">
<?php if (empty($cart_items)): ?>
    <p>カートに商品がありません。</p>
<?php else: ?>
    <?php foreach ($cart_items as $item): ?>
        <section class="cart-item">
            <form action="../back/cart.php" method="post">
                <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']) ?>">
                <button type="submit" name="remove" class="remove-btn">×</button>
            </form>

            <img src="<?= htmlspecialchars($item['img_path'] ?? 'noimage.jpg') ?>" 
                 alt="<?= htmlspecialchars($item['name']) ?>" />
            <div class="info">
                <strong><?= htmlspecialchars($item['name']) ?></strong>
                <div>価格：<?= htmlspecialchars($item['price']) ?>円</div>
                <div>数量：
                    <?php
                        foreach ($_SESSION['cart'] as $c) {
                            if ($c['item_id'] == $item['id']) {
                                echo (int)$c['quantity'];
                                break;
                            }
                        }
                    ?>
                </div>
                <a href="order.php?item_id=<?= $item['id'] ?>" class="order-link">商品注文画面へ</a>
            </div>
        </section>
    <?php endforeach; ?>
<?php endif; ?>
</div>
<div class="button-area">
    <button class="btn-back">戻る</button>
    <button class="btn-order">注文</button>
</div>

</body>
</html>
