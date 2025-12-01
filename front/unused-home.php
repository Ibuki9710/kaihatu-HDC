<?php 
require 'header.html';
require 'list.html';
?>
<div class="main">
    <div class="center-content">
        <h2>出品中</h2>
    </div>
    <div class="small-boxes-wrapper showProduct">
        //例
        <div class="card">
            <img src="../image/1.png" class="image">
            <p>不用品名</p>
        </div>
        <div class="card">
            <img src="../image/1.png" class="image">
            <p>不用品名</p>
        </div>
        <div class="card">
            <img src="../image/1.png" class="image">
            <p>不用品名</p>
        </div>
        <div class="card">
            <img src="../image/1.png" class="image">
            <p>不用品名</p>
        </div>
        <div class="card">
            <img src="../image/1.png" class="image">
            <p>不用品名</p>
        </div>
        <div class="card">
            <img src="../image/1.png" class="image">
            <p>不用品名</p>
        </div>
    </div>
    <div class="center-content">
        <h2>取引中</h2>
    </div>
    <div class="small-boxes-wrapper showProduct">
        //ここに不用品の表示処理
        div class="card"で囲んでimgにclass="image"をつける
    </div>
    <div class="center-content">
        <h2>取引完了</h2>
    </div>
    <div class="small-boxes-wrapper showProduct">
        //ここに不用品の表示処理
        div class="card"で囲んでimgにclass="image"をつける
    </div>
    <div class="listing grey">
        <a href="listing.php" class="black">+</a>
    </div>
</div>
<?php require 'footer.html'; ?>