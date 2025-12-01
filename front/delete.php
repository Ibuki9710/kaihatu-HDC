<?php session_start();
    require 'header3.html'; 
?>

<div class="center">
    <font color="red" >
        「退会する」ボタンを押すと退会が完了します。<br>
        本当に退会してもよろしいですか？
    </font>
    <div class="btn-group">
        <a href="javascript:history.back();"><button class="blueBtn btn-base">戻る</button></a>
        <a href="back_login.php"><button class="redBtn btn-base">退会する</button></a>
    </div>  
</div>
<?php require 'footer.html'; ?>