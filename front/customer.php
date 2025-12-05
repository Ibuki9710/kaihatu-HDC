<?php
    require 'header2.html';
?>
<div class="form-container">
    <div class="center-content">
        <h2>会員登録</h2>
    </div>
    <div class="center">
        <form action="../back/customer_input.php" method="post">
            <p class="input-row">
                <label>メールアドレス<font color="red">（必須）</font></label>
                <input type="text" name="email"  id="email" class="customer-text" placeholder="メールアドレス（電話番号）"> 
            </p>
            <p class="input-row">
                <label>パスワード<font color="red">（必須）</font></label>
                <input type="password" name="password"  id="pass" class="customer-text" placeholder="パスワード"> 
            </p>
            <p class="input-row">
                <label>氏名<font color="red">（必須）</font></label>
                <input type="text" name="name"  id="name1" class="customer-text" placeholder="氏名"> 
            </p>
            <p class="input-row">
                <label>生年月日<font color="red">（必須）</font></label>
                <select name="barth_year" class="min-text" id="barth-year"></select>年
                <select name="barth_month"class="min-text" id="barth-month"></select>月
                <select name="barth_day" class="min-text" id="barth-day"></select>日
            </p>
            <p id="errorMsg"></p>
            <div class="center">
                <button type="submit" class="greenBtn btn-base btn-wrapper">登録確認画面へ</button>
            </div>
        </form>
    </div>
</div>

<?php
    require 'footer.html';
?>