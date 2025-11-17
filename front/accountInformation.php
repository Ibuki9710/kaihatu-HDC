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
            <form acton="" method="post">
                <div class="input-row">
                    <label class="input-label" for="account-name">アカウント名</label>
                    <div class="input-field-area"> 
                        <input type="text" name="" id="account-name" class="input-field"> 
                    </div>
                </div>
                <div class="input-row">
                    <label class="input-label" for="account-mail">メールアドレス</label>
                    <div class="input-field-area"> 
                        <input type="email" name="" id="account-mail" class="input-field"> 
                    </div>
                </div>
                <div class="input-row">
                    <label class="input-label" for="account-phon">電話番号</label>
                    <div class="input-field-area"> 
                        <input type="text" name="" id="account-phon" class="input-field"> 
                    </div>
                </div>
                <div class="empty"></div>
                <div class="center">
                    <button type="submit" class="btn-base blueBtn btn-wrapper">変更</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require 'footer-admin.html' ?>