<?php
require 'header-admin.html';
require 'list-admin.html';
?>

<div class="conteiner-header">
    <h2>基本情報設定</h2>
</div>
<div class="admin-main">
    <div class="conteiner-admin">
        <div class="form-container">
            <h3>アカウント管理</h3>
            <form action="accountInformation.php" method="post">
                <div class="input-row">
                    <label class="input-label">アカウント名</label>
                    <div class="input-field-area"> 
                        <input type="text" name="user" class="input-base-text" placeholder="admin"> 
                    </div>
                </div>
                <div class="input-row">
                    <label class="input-label">メールアドレス</label>
                    <div class="input-field-area"> 
                        <input type="email" name="adress" class="input-base-text" placeholder="admin@gmail.com"> 
                    </div>
                </div>
                <div class="input-row">
                    <label class="input-label">電話番号</label>
                    <div class="input-field-area"> 
                        <input type="text" name="tere" class="input-base-text" placeholder="123-456-789"> 
                    </div>
                </div>
                <div class="empty"></div>
                <div class="center">
                    <a href="login.php">    
                        <bnutton class="btn-base blueBtn btn-wrapper">ログアウト</button>
                    </a>
                </div>
                <p>バージョン確認　　　　2-2.2.2.0</p>
            </form>
        </div>
    </div>
</div>

<?php require 'footer-admin.html' ?>