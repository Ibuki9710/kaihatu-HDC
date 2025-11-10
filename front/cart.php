<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart.php</title>
</head>
<body>
    <h1>カート一覧</h1>
    <form action="../back/cart.php" method="post">
  <input type="hidden" name="item_id" value="1">
  <input type="hidden" name="item_name" value="サンプル商品">
  <input type="hidden" name="price" value="500">
  <button type="submit" name="add_cart">カートに追加</button>
</form>
    
</body>
</html>
<?php
require 'footer.php';
?>