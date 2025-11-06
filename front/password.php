<?php
    require 'header2.html';
?>
<br>
    <div class="form-container">
        <div class="center-content">
            <h2>パスワードの再設定</h2>
        </div>
        <form action="login.php" method="post">
            <div class="center">
                <p class="input">
                    <label>メールアドレス</label>
                    <input type="text" name=""  id="email" class="customer-text" placeholder="メールアドレス"> 
                </p>
                <p class="input">
                    <label class="label">パスワード</label>
                    <input type="password" name="" id="pass" class="customer-text" placeholder="パスワード"> 
                </p>
                <button class="greenBtn btn-base btn-wapper">保存</button>
            </div>
        </form>
    </div>
<?php
    require 'footer.html';
?>
