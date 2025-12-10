<?php 
session_start();
require 'header.html';
?>
<div class="form-container">
    <div class="center-content">
        <h2>注文履歴</h2>
    </div>
    <?php  require '../back/order-history.php'; ?>
    <a href="javascript:history.back();">
        <button class="blueBtn btn-base">戻る</button>
    </a>
</div>