<?php
    require 'header.html';
?>
<div class="center">
    <div class="form-container">
        <div class="center-content">
            <h2 class="h2">お届け先</h2>
        </div>
        <div class="center-content">
            <h2 class="h2">追加</h2>
        </div>
        <form action="address.php" method="post">
            <div class="input-row">
                <label class="input-label" for="zipcode">郵便番号</label>
                <div class="input-field-area">
                    <input type="text" name="" id="zipcode" maxlength="7" placeholder="1000001">
                    <button type="button" id="searchButton" class="menu-btn">検索</button>
                </div>
            </div>
    
            <div class="input-row">
                <label class="input-label" for="address">住所</label>
                <div class="input-field-area">
                    <input type="text" id="address" name="" class="input-base-text" placeholder="市町村番地"> 
                </div>
            </div>
            </form>
            <div class="center">
                <div class="btn-group">
                    <a href="address.php"><button class="redBtn btn-base btn-wrapper">削除</button></a>
                    <button  type="submit" class="greenBtn btn-base btn-wrapper">保存</button>
                </div>
            <a href="customer-menu.php"><button class="blueBtn btn-base btn-wrapper">戻る</button></a>
        </div>
        
    </div>
<?php
    require 'footer.html';
?>