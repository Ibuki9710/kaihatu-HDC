<?php 
require '../back/login.php';
require '../back/re_password.php';
require 'header2.html'; 
?>
<br>

<div class="login">
    <div class="form-container">
        <div class="login-header">
            <h3><i class="fas fa-envelope fa-2x"></i>メールアドレスでログイン</h3>
        </div>
        <div class="login-container">
            <form action="../back/login.php" method="post">
                <p><input type="email" class="customer-text" name="email" placeholder="メールアドレス"></p>
                <p><input type="password" class="customer-text" name="password" placeholder="パスワード"></p>
                <p><input type="checkbox" name="check" class="label">IDを保持する</p>
                <div class="center">
                    <button type="submit" class="login-btn thinblue">ログイン</button>
                </div>
            </form>
        <p><a href="password.php" class="blue-text">→パスワードを忘れた場合はこちら</a></p>
        </div>
        <h3>まだ会員でない方</h3>
    <a href="customer.php">
        <div class="center">
            <button type="submit" class="login-btn thinblue">新規会員登録はこちら</button>
        </div>
    </a>
    </div>
    
</div>

<?php require 'footer.html'; ?>
