<?php require 'header.html'; ?>
<br>
<div class="form-container">
    <div class="center-content">
        <h2>会員メニュー</h2>
    </div>
    <div class="center">
        <a href="customer-update.php" class="black">
            <div class="container btn-wrapper grey left">
                <h4>会員情報の確認・変更</h4>
            </div>
        </a>
        <a href="cart-history.php" class="black">
            <div class="container btn-wrapper grey left">
                <h4>注文履歴照会</h4>
            </div>
        </a>
        <a href="address.php" class="black">
            <div class="container btn-wrapper grey left">               
                <h4>住所追加・変更</h4>
            </div>
        </a>
        <a href="customer.php" class="black">
            <div class="container btn-wrapper grey left">
                <h4>お知らせ</h4>
            </div>
        </a>
        <a href="help.php" class="black">
            <div class="container btn-wrapper grey left">
                <h4>よくある質問</h4>
            </div>
        </a>
        <a href="login.php" class="black">
            <div class="container btn-wrapper grey left">
                <h4>ログアウト</h4>
            </div>
        </a>
       <a href="../back/logout.php" class="black" onclick="return confirmDelete();">
    <div class="container btn-wrapper grey left">
        <h4>退会</h4>
    </div>
</a>

<script>
function confirmDelete() {
    return confirm('本当に退会しますか？退会するとアカウントは復元できません。');
}
</script>

        <br>
        <a href="javascript:history.back();">
            <button type="submit" class="blueBtn btn-base btn-wrapper">戻る</button>
        </a>
    </div>
</div>
    