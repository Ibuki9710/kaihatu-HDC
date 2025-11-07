<?php
    require 'header.html';
?>
<br>
<br>
    <h2 class="h2">お届け先</h2>


    <h2 class="h2">追加</h2>
    <div class="form-container">
        <form action="address.php" method="post">
            <p class="input">
                <label>郵便番号<font color="red"></font></label><br>
                <input type="text" name=""  class="min-text" placeholder="000">ー
                <input type="text" name=""  class="min-text" placeholder="0000">
            </p>
            <p class="input">
                <label>都道府県<font color="red">（必須）</font></label><br>
                <input type="text" name="" class="customer-text" placeholder="都道府県名"> 
            </p>
            <p class="input">
                <label>市区町村<font color="red">（必須）</font></label><br>
                <input type="text" name="" class="customer-text" placeholder="市区町村"> 
            </p>
            <p class="input">
                <label>番地<font color="red">（必須）</font></label><br>
                <input type="text" name="" class="customer-text" placeholder="番地"> 
            </p>
        </form>
        <div class="center">
                <div class="btn-group">
                    <a href="address.php"><button class="redBtn btn-base btn-wrapper">削除</button></a>
                    <button  type="submit" class="greenBtn btn-base btn-wrapper">保存</button>
                </div>
            <a href="customer-menu.html"><button class="blueBtn btn-base btn-wrapper">戻る</button></a>
        </div>
        
    </div>
<?php
    require 'footer.php';
?>