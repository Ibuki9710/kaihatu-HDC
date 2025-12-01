<?php 
session_set_cookie_params(['path' => '/']); 
session_start();
$items = $_SESSION['items'] ?? [];
require 'header.html';
require 'list.html';
?>
<div class="main">
<div class="center-content">
<h2>商品一覧</h2>
</div>
<div class="small-boxes-wrapper showProduct">
<?php if (empty($items)): ?>
<p>商品データがありません。</p>
<?php else: ?>
<?php foreach ($items as $item): ?>
<div class="card">
<img src="../image/<?= htmlspecialchars($item['item_id']) ?>.png"alt="<?= htmlspecialchars($item['item_name']) ?>" class="image">
<h3><?= htmlspecialchars($item['item_name']) ?></h3>
<p>価格: <?= htmlspecialchars($item['price']) ?>円</p>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
</div>
<?php require 'footer.html'; ?>
