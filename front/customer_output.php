<?php
session_start();
if (!isset($_SESSION['register_success'])) {
    header('Location: customer.php');
    exit;
}
unset($_SESSION['register_success']);

require 'header2.html';
?>

<div class="form-container">
    <div class="center-content">
        <h2>会員登録完了</h2>
        <p>会員登録が完了しました。</p>
        <p>ご登録ありがとうございます。</p>
        <div class="center">
            <a href="login.php" class="greenBtn btn-base btn-wrapper">ログイン画面へ</a>
        </div>
    </div>
</div>

<?php
require 'footer.html';
?>