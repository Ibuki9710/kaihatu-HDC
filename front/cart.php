<?php 
session_start();
require 'header.html';
?>

<div class="form-container">
    <div class="center-content">
        <h1>カート一覧</h1>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message">
            <?php 
            echo htmlspecialchars($_SESSION['success']); 
            unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?php 
            echo htmlspecialchars($_SESSION['error']); 
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <div class="cart-list">
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php 
            $total = 0;
            foreach ($_SESSION['cart'] as $product): 
                $subtotal = $product['price'] * $product['count'];
                $total += $subtotal;
            ?>
                <section class="cart-item">
                    <form method="POST" action="../back/cart-delete.php" style="display:inline;">
                        <input type="hidden" name="item_id" value="<?php echo $product['item_id']; ?>">
                        <button type="submit" class="remove-btn" aria-label="商品を削除" 
                                onclick="return confirm('この商品をカートから削除しますか？');">×</button>
                    </form>
                    
                    <img src="<?php echo htmlspecialchars($product['img_path']); ?>" 
                         alt="<?php echo htmlspecialchars($product['item_name']); ?>" 
                         onerror="this.src='../image/no-image.png'">
                    
                    <div class="info">
                        <strong><?php echo htmlspecialchars($product['item_name']); ?></strong>
                        <div>価格　<?php echo number_format($product['price']); ?>円</div>
                        <div>送料　無料</div>
                        <div>数量　<?php echo $product['count']; ?>個</div>
                        <div>小計　<?php echo number_format($subtotal); ?>円</div>
                    </div>
                </section>
            <?php endforeach; ?>
            
            <div class="cart-total">
                <strong>合計金額：<?php echo number_format($total); ?>円</strong>
            </div>
            
        <?php else: ?>
            <p class="empty-cart">カートに商品がありません。</p>
        <?php endif; ?>
    </div>

    <div class="button-area">
        <button class="btn-back button" onclick="location.href='home.php'">戻る</button>
        <?php if (!empty($_SESSION['cart'])): ?>
            <button class="btn-order button" onclick="location.href='order.php'">注文</button>
        <?php endif; ?>
    </div>
</div>

<style>





.cart-list {
    margin: 20px 0;
}

.cart-item {
    display: flex;
    align-items: center;
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 15px;
    position: relative;
    border-radius: 8px;
}

.cart-item img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin-right: 20px;
    border-radius: 5px;
}

.cart-item .info {
    flex: 1;
}

.cart-item .info > div {
    margin: 5px 0;
}

.remove-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #e74c3c;
    color: white;
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    line-height: 1;
}

.remove-btn:hover {
    background-color: #c0392b;
}

.cart-total {
    text-align: right;
    padding: 20px;
    font-size: 20px;
    border-top: 2px solid #333;
    margin-top: 20px;
}

.empty-cart {
    text-align: center;
    padding: 40px;
    color: #666;
}

.button-area {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.button {
    padding: 12px 30px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.btn-back {
    background-color: #95a5a6;
    color: white;
}

.btn-back:hover {
    background-color: #7f8c8d;
}

.btn-order {
    background-color: #27ae60;
    color: white;
}

.btn-order:hover {
    background-color: #229954;
}

.success-message {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    margin-bottom: 15px;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    margin-bottom: 15px;
}
</style>

</main>    
</body>
</html>