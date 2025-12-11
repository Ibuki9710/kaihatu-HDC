<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php'; // DB接続

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. POSTデータ受け取り
    $name        = trim($_POST['unnecessary_items_name'] ?? '');
    $price       = trim($_POST['price'] ?? '');
    $description = trim($_POST['unnecessary_items_explain'] ?? '');
    $width       = trim($_POST['width'] ?? '');
    $height      = trim($_POST['height'] ?? '');
    $brand       = $_POST['brand'] ?? '';

    // 2. バリデーション
    if ($name === '') $errors[] = "商品名は必須です。";
    if ($brand === '') $errors[] = "ブランドは必須です。";
    if ($width !== "" && !is_numeric($width)) $errors[] = "横幅は数字で入力してください。";
    if ($height !== "" && !is_numeric($height)) $errors[] = "縦幅は数字で入力してください。";
    if ($price === "" || !is_numeric($price)) $errors[] = "価格は数字で入力してください。";

    // 3. 画像アップロード準備
    $upload_dir = '../image/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $image_path = 'image.png'; // デフォルト
    $temp_file = null;
    $ext = 'png';
    
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $allowed)) $ext = 'png';

        // 一時的にファイルを保存
        $temp_file = $_FILES['image']['tmp_name'];
    }

    // 4. エラーがあれば表示して終了
    if (!empty($errors)) {
        echo "<h2>エラーがあります</h2>";
        foreach ($errors as $e) echo "<p>・" . htmlspecialchars($e) . "</p>";
        echo '<a href="../front/listing.php">戻る</a>';
        exit;
    }

    // 5. DB保存（画像は仮のファイル名で登録）
    $sql = "INSERT INTO item
            (item_name, price, item_explain, width, height, image, brand, item_stock)
            VALUES (:name, :price, :description, :width, :height, :image, :brand, 1)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name',  $name, PDO::PARAM_STR);
    $stmt->bindValue(':price', (int)$price, PDO::PARAM_INT);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':width', $width === "" ? null : (int)$width, $width === "" ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $stmt->bindValue(':height', $height === "" ? null : (int)$height, $height === "" ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $stmt->bindValue(':image', $image_path, PDO::PARAM_STR);
    $stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
    $stmt->execute();

    // 6. 挿入されたitem_idを取得
    $item_id = $pdo->lastInsertId();

    // 7. item_idを使ってファイル名を確定し、画像を保存
    if ($temp_file !== null) {
        $filename = $item_id . '.' . $ext;
        $target = $upload_dir . $filename;

        if (move_uploaded_file($temp_file, $target)) {
            $image_path = $filename;
            
            // DBのimageカラムを更新
            $update_sql = "UPDATE item SET image = :image WHERE item_id = :item_id";
            $update_stmt = $pdo->prepare($update_sql);
            $update_stmt->bindValue(':image', $image_path, PDO::PARAM_STR);
            $update_stmt->bindValue(':item_id', $item_id, PDO::PARAM_INT);
            $update_stmt->execute();
        } else {
            $errors[] = "画像のアップロードに失敗しました。";
        }
    }

    // 8. 完了メッセージ
    $_SESSION['success'] = "商品を登録しました!";
    header('Location: ../front/home-sample.php');
    exit;
}
?>