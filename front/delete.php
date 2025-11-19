<?php session_start();
    require 'header3.html'; 
?>

<div class="center">
    <p><font color="red">
        「退会する」ボタンを押すと退会が完了します。<br>
        本当に退会してもよろしいですか？
    </p></font>
    <div class="btn-group">
        <a href="customer-menu.php"><button class="blueBtn btn-base">戻る</button></a>
        <a href="../back/login.php"><button class="redBtn btn-base">退会する</button></a>
    </div>  
</div>
<?php require 'footer.html'; ?>