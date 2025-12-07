<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        // POSTデータの取得
        $item_name = $_POST['item_name'];
        $item_explain = $_POST['item_explain'];
        $price = (int)$_POST['price']; // 価格を追加
        $stock = isset($_POST['unlimited']) ? 999999 : (int)$_POST['stock'];
        $width = (int)$_POST['width'];
        $height = (int)$_POST['height'];
        $public = $_POST['public'] === 'open' ? 1 : 0;

        // 1. DBに商品情報を登録（画像は後で）
        $stmt = $pdo->prepare("
            INSERT INTO item (item_name, item_explain, price, item_stock, width, height, be_solditem)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$item_name, $item_explain, $price, $stock, $width, $height, $public]);

        // 2. 登録した商品のIDを取得
        $item_id = $pdo->lastInsertId();

        // 3. 画像がアップロードされている場合
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $uploadDir = '../image/';  // 画像保存ディレクトリ
            $tmpName = $_FILES['image']['tmp_name'];
            
            // 商品ID.png で保存
            $filename = $item_id . '.png';
            move_uploaded_file($tmpName, $uploadDir . $filename);
        }

        $_SESSION['success'] = "商品登録が完了しました";
        header('Location: ../front/product.php');
        exit;

    } catch (PDOException $e) {
        $_SESSION['error'] = "商品登録中にエラーが発生しました: " . $e->getMessage();
        header('Location: ../front/product.php');
        exit;
    }
}
?>
