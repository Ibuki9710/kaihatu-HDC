<?php 
session_set_cookie_params(['path' => '/']); 
session_start();
require 'header.html';
require 'list.html';
?>
<div class="main">
<h2>商品一覧</h2>
<div class="item-list">
        <?php require '../back/product-display.php'; ?>
    </div>
</div>
<?php require 'footer.html'; ?>
