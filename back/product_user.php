<?php
session_start();
require_once 'db_connect.php';

// ログインチェック
if (!isset($_SESSION['member_id'])) {
    $_SESSION['error'] = 'ログインが必要です';
    header('Location: ../front/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // 画像アップロード処理
        $image_name = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $file_type = $_FILES['image']['type'];
            
            if (in_array($file_type, $allowed_types)) {
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $image_name = uniqid() . '.' . $extension;
                $upload_path = '../image/' . $image_name;
                
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    throw new Exception('画像のアップロードに失敗しました');
                }
            } else {
                throw new Exception('画像ファイル形式が不正です（JPEG, PNG, GIFのみ）');
            }
        }
        
        // データベースに登録
        $stmt = $pdo->prepare("
            INSERT INTO notitem 
            (unnecessary_items_name, price, unnecessary_items_explain, width, height, brand, image, be_solditem, member_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?)
        ");
        
        $stmt->execute([
            $_POST['unnecessary_items_name'],
            $_POST['price'],
            $_POST['unnecessary_items_explain'],
            !empty($_POST['width']) ? (int)$_POST['width'] : null,
            !empty($_POST['height']) ? (int)$_POST['height'] : null,
            !empty($_POST['brand']) ? $_POST['brand'] : null,
            $image_name,
            $_SESSION['member_id']
        ]);
        
        $_SESSION['success'] = '商品を出品しました';
        header('Location: ../front/home.php');
        exit;
        
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../front/listing.php');
        exit;
    }
}
?>