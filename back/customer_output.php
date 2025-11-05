<?php
if (isset($_SESSION['customer'])) {
    $id=$_SESSION['customer']['member_id'];
    $sql=$pdo->prepare('select * from customer where member_id!=?');
    $sql->execute([$id]);
} else {
    $sql=$pdo->prepare('select * from customer where login=?');
    $sql->execute([$_POST['login']]);
}

if (empty($sql->fetchAll())) {
    if (isset($_SESSION['customer'])) {
        $sql=$pdo->prepare('update customer set member_email=?, password=? where member_id=?');
        $sql->execute(
            [
                $_POST['member_email'],
                $_POST['password'],
                $id
            ]
        );
        $_SESSION['customer']=[
            'id'=>$id,  
            'login'=>$_POST['member_email'],
            'password'=>$_POST['password']
        ];
        echo 'お客様情報を更新しました。';
    } else {
        $sql=$pdo->prepare('insert into customer values(null,?,?)');
        $sql->execute(
            [
                $_POST['member_email'],
                $_POST['password']
            ]
        );
        echo 'お客様情報を登録しました。';
    }
} else {
    echo 'ログイン名がすでに使用されていますので、変更してください。';
}
?>