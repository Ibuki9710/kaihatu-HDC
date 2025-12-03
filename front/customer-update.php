<?php
    require 'header2.html';
?>
<div class="form-container">
    <div class="center-content">
        <h2>会員情報の確認・変更</h2>
    </div>
    <div class="center">
        <form action="customer-menu.php" id="edit-form" method="post">
            <div class="input-row">
                <label>メールアドレス<font color="red">（必須）</font></label>
                <input type="email" name=""  id="email" class="customer-text" placeholder="メールアドレス"> 
            </div>
            <div class="input-row">
                <label>パスワード<font color="red">（必須）</font></label>
                <input type="password" name=""  id="pass" class="customer-text" placeholder="パスワード"> 
            </div>
            <div class="input-row">
                <label>氏名<font color="red">（必須）</font></label>
                <input type="text" name=""  id="name1" class="customer-text" placeholder="氏名"> 
            </div>
            <div class="input-row">
                <label>フリガナ<font color="red">（必須）</font></label>
                <input type="text" name=""  id="name2" class="customer-text" placeholder="氏名（フリガナ）"> 
            </div>
            <div class="input-row">
                <label>生年月日<font color="red">（必須）</font></label>
                <select name="" class="min-text" id="barth-year"></select>年
                <select name=""class="min-text" id="barth-month"></select>月
                <select name="" class="min-text" id="barth-day"></select>日
            </div>
            <div class="input-row">
                <label>支払方法<font color="red">（必須）</font></label>
                <select name="" class="customer-text">
                    <option disabled selected></option>
                    <option value="">paypay</option>
                    <option value="">クレジットカード</option>
                </select>
            </div>
            <div id="errorMsg"></div>
        </form>
        <div class="btn-group">
            <a href="javascript:history.back();">
                <button class="blueBtn btn-base">戻る</button>
            </a>
            <button  type="submit" class="greenBtn btn-base" form="edit-form">変更</button>
        </div>
    </div>
</div>
<?php
    require 'footer.html';
?>