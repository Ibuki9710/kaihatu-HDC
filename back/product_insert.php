<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item_name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $brand = $_POST['brand'] ?? '';
    $item_explain = $_POST['item_explain'] ?? '';
    $item_stock = isset($_POST['unlimited']) ? 9999 : $_POST['item_stock'];
    $width = $_POST['width'] ?? 0;
    $height = $_POST['height'] ?? 0;
    $depth = $_POST['depth'] ?? 0;
    $be_solditem = $_POST['be_solditem'] ?? 1;

    try {
        // DB登録
        $stmt = $pdo->prepare("
            INSERT INTO item (item_name, price, brand, item_explain, item_stock, width, height, depth, be_solditem)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$item_name, $price, $brand, $item_explain, $item_stock, $width, $height, $depth, $be_solditem]);

        // 最後に登録された item_id を取得
        $item_id = $pdo->lastInsertId();

        // 画像アップロード処理
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $tmpName = $_FILES['image']['tmp_name'];
            $filename = "../image/{$item_id}.png";

            // 画像サイズ取得
            list($origWidth, $origHeight) = getimagesize($tmpName);

            // 最大幅を500pxにリサイズ
            $newWidth = 500;
            $newHeight = ($origHeight / $origWidth) * $newWidth;

            $srcImage = imagecreatefromstring(file_get_contents($tmpName));
            $dstImage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

            imagepng($dstImage, $filename);
            imagedestroy($srcImage);
            imagedestroy($dstImage);
        }

        $_SESSION['success'] = "商品登録が完了しました";
        header('Location: ../front/product.php');
        exit;

    } catch (PDOException $e) {
        echo "商品登録中にエラーが発生しました: " . htmlspecialchars($e->getMessage());
    }
}
