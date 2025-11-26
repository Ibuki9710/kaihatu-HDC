<?php 
session_start();
$items = $_SESSION['items'] ?? [];

require 'header.html';
require 'list.html';
?>
<div class="main">
<h2>商品一覧</h2>
<div class="item-list">

<?php foreach ($items as $item): ?>
    <div class="item-card">
        <img src="../image/<?= $item['item_id'] ?>.png">
        <h3><?= htmlspecialchars($item['item_name']) ?></h3>
        <p><?= htmlspecialchars($item['price']) ?>円</p>
    </div>
<?php endforeach; ?>

</div>
</div>
<?php require 'footer.html'; ?>
