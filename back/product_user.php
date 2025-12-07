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

    // 3. 画像アップロード（../noimage/ フォルダに保存）
    $upload_dir = '../noimage/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $image_path = 'noimage.png'; // デフォルト
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $allowed)) $ext = 'png';

        $filename = 'notitem_' . time() . '.' . $ext;
        $target = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = $filename; // DBにはファイル名のみ保存
        } else {
            $errors[] = "画像のアップロードに失敗しました。";
        }
    }

    // 4. エラーがあれば表示して終了
    if (!empty($errors)) {
        echo "<h2>エラーがあります</h2>";
        foreach ($errors as $e) echo "<p>・" . htmlspecialchars($e) . "</p>";
        echo '<a href="../front/listing.php">戻る</a>';
        exit;
    }

    // 5. DB保存
    $sql = "INSERT INTO notitem
            (unnecessary_items_name, price, unnecessary_items_explain, width, height, image, not_brand, created_at)
            VALUES (:name, :price, :description, :width, :height, :image, :brand, NOW())";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name',  $name, PDO::PARAM_STR);
    $stmt->bindValue(':price', (int)$price, PDO::PARAM_INT);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':width', $width === "" ? null : (int)$width, $width === "" ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $stmt->bindValue(':height', $height === "" ? null : (int)$height, $height === "" ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $stmt->bindValue(':image', $image_path, PDO::PARAM_STR);
    $stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
    $stmt->execute();

    // 6. 完了メッセージ
    $_SESSION['success'] = "商品を登録しました！";
    header('Location: ../front/home-sample.php');
    exit;
}
?>
