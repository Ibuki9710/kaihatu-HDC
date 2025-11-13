<?php session_start();
    require 'header3.html'; 
?>

<div class="center">
    <p><font color="red">
        「退会する」ボタンを押すと大会が完了します。<br>
        本当に退化してもよろしいですか？
    </p></font>
    <div class="btn-group">
        <a href="customer-menu.php"><button class="blueBtn btn-base">戻る</button></a>
        <a href="login.php"><button class="redBtn btn-base">退会する</button></a>
    </div>  
</div>
<?php require 'footer.html'; ?>