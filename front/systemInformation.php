<?php
require 'header-admin.html';
require 'list-admin.html';
?>
<div class="conteiner-header">
    <h2>システム情報設定</h2>
</div>
<div class="admin-main">
    <div class="conteiner-admin">
        <div class="form-container">
            <h3>店舗状況</h3>
            <form acton="" method="post">
                <div class="input-row">
                    <label class="input-label">会社名</label>
                    <div class="input-field-area"> 
                        <input type="text" name="" class="input-base-text"> 
                    </div>
                </div>
                <div class="input-row">
                    <label class="input-label"">会社名（カナ）</label>
                    <div class="input-field-area"> 
                        <input type="text" name="" class="input-base-text"> 
                    </div>
                </div>
                <div class="input-row">
                    <label class="input-label">店名</label>
                    <div class="input-field-area"> 
                        <input type="text" name="" class="input-base-text"> 
                    </div>
                </div>
                <div class="input-row">
                    <label class="input-label" for="zipcode">郵便番号</label>
                    <div class="input-field-area">
                        <input type="text" name="" id="zipcode" maxlength="7" placeholder="1000001">
                        <button type="button" id="searchButton" class="menu-btn">検索</button>
                    </div>
                </div>
        
                <div class="input-row">
                    <label class="input-label" for="address">住所</label>
                    <div class="input-field-area">
                        <input type="text" id="address" name="" class="input-base-text" placeholder="市町村番地"> 
                    </div>
                </div>
                <div class="input-row">
                    <label class="input-label">送信メールアドレス</label>
                    <div class="input-field-area"> 
                        <input type="email" name="" class="input-base-text"placeholder="email@example.com"> 
                    </div>
                </div>
                <div class="center">
                    <button type="submit" class="btn-base blueBtn btn-wapper">変更</button>
                </div>
            </form>
            <p>バージョン確認　　　　2-2.2.2.0</p>
        </div>
    </div>
</div>
<?php require 'footer-admin.html'; ?>