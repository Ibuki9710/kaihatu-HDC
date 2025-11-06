<?php require 'header2.html'; ?>
<br>
<div class="login">
    <div class="form-container">
        <div class="login-header">
            <h3>メールアドレスでログイン</h3>
        </div>
        <div class="login-container">
            <form action="home.php" method="post">
                <p><input type="email" class="customer-text" name="" placeholder="メールアドレス"></p>
                <p><input type="password" class="customer-text" name="" placeholder="パスワード"></p>
                <p><input type="checkbox" name="check" class="label">IDを保持する</p>
                <div class="center">
                    <button type="submit" class="login-btn thinblue">ログイン</button>
                </div>
            </form>
              <?php
      session_start();
      if (!empty($_SESSION['login_error'])) {
          echo '<p style="color:red;">' . $_SESSION['login_error'] . '</p>';
          unset($_SESSION['login_error']); // 1回表示したら消す
      }
      ?>
        <p><a href="password.php" class="blue-text">→パスワードを忘れた場合はこちら</a></p>
        </div>
    </div>
        <h3>まだ会員でない方</h3>
    <a href="customer.php">
        <div class="center">
            <button type="submit" class="login-btn thinblue"><p>新規会員登録はこちら</p></button>
        </div>
    </a>
</div>
<?php require 'footer.html'; ?>
