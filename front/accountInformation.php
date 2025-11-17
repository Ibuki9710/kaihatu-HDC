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
                    <label class="input-label">アカウント名</label>
                    <div class="input-field-area"> 
                        <input type="text" name="" class="input-field"> 
                    </div>
                </div>
                <div class="input-row">
                    <label class="input-label">メールアドレス</label>
                    <div class="input-field-area"> 
                        <input type="email" name="" class="input-field"> 
                    </div>
                </div>
                <div class="input-row">
                    <label class="input-label">電話番号</label>
                    <div class="input-field-area"> 
                        <input type="text" name="" class="input-field"> 
                    </div>
                </div>
                <div class="empty"></div>
                <div class="center">
                    <button type="submit" class="btn-base blueBtn btn-wrapper">変更</button>
                </div>
                <p>バージョン確認　　　　2-2.2.2.0</p>
            </form>
        </div>
    </div>
</div>

<?php require 'footer-admin.html' ?>