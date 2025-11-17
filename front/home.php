<?php
session_set_cookie_params(['path' => '/']); 
session_start();
$items = $_SESSION['items'] ?? [];

require 'header.html';
require 'list.html';
?>
<div class="main">
<h2>商品一覧</h2>
<div class="item-list">
<?php if (empty($items)): ?>
<p>商品データがありません。</p>
<?php else: ?>
<?php foreach ($items as $item): ?>
<div class="item-card">
<img src="../images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['item_name']) ?>">
<h3><?= htmlspecialchars($item['item_name']) ?></h3>
<p>価格: <?= htmlspecialchars($item['price']) ?>円</p>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
</div>
<?php require 'footer.html'; ?>
