<?php session_start();
    require 'header3.html'; 
?>
    <p>退会しました</p>
    <form action="home.php"method="post">
        <button type="submit"　class="btn btn-primary">ホームへ戻る</button>
    </form>
<?php require 'footer.html'; ?>