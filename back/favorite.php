<?php
session_start();

if (!isset($_SESSION['favorite'])) $_SESSION['favorite'] = [];

// 追加
if (isset($_POST['add_fav'])) {
    $_SESSION['favorite'][$_POST['item_id']] = $_POST['item_name'];
}

// 削除
if (isset($_POST['remove_fav'])) {
    unset($_SESSION['favorite'][$_POST['item_id']]);
}

header('Location: ../front/favorite.php');
exit;
