<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ======================================================
// 商品登録バックエンド  product_admin.php
// フロントのフォームに完全対応したバージョン
// ======================================================

// DB接続
require_once 'db_connect.php';   // ★あなたの DB接続ファイル名に合わせて変更

// ↓ここから$pdoが使える
$stmt = $pdo->prepare("SELECT * FROM notitem");
$stmt->execute();
$rows = $stmt->fetchAll();
// エラー表示用
$errors = [];

// POST送信か確認
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // -----------------------------
    // 1. 受け取り
    // -----------------------------
    $name        = trim($_POST['unnecessary_items_name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $description = $_POST['unnecessary_items_explain'] ?? null;
    $stock       = $_POST['stock'] ?? null;
    $unlimited   = isset($_POST['unlimited_stock']) ? 1 : 0;
    $width       = $_POST['width'] ?? null;
    $height      = $_POST['height'] ?? null;
    $public      = $_POST['public'] ?? 0; // 1=公開,0=非公開

    // -----------------------------
    // 2. バリデーション
    // -----------------------------
    if ($name === '') {
        $errors[] = "商品名は必須です。";
    }

    // サイズ
    if ($width !== "" && $width < 0) $errors[] = "横幅が不正です。";
    if ($height !== "" && $height < 0) $errors[] = "縦幅が不正です。";

    // -----------------------------
    // 3. 画像アップロード処理
    // -----------------------------
    $image_path = null;

    if (!empty($_FILES['image']['name'])) {

        $upload_dir = '../image/';   // ★保存先ディレクトリ
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $filename = date('YmdHis') . '_' . basename($_FILES['image']['name']);
        $target = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = $filename;  // DBにはファイル名だけ保存
        } else {
            $errors[] = "画像アップロードに失敗しました。";
        }
    }

    // -----------------------------
    // 4. エラーがあれば表示して中断
    // -----------------------------
    if (!empty($errors)) {
        echo "<h2>エラーがあります</h2>";
        foreach ($errors as $e) {
            echo "<p>・" . htmlspecialchars($e) . "</p>";
        }
        echo '<a href="../front/product-insert.php">戻る</a>';
        exit;
    }

    // -----------------------------
    // 5. DB保存
    // -----------------------------
    $sql = "INSERT INTO notitem 
            (unnecessary_items_name, price, unnecessary_items_explain, created_at, width, height, image)
            VALUES (:name, :price, :description, NOW(), :width, :height, :image)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':name',  $name, PDO::PARAM_STR);
    $stmt->bindValue(':price', $price, PDO::PARAM_INT);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':width', $width === "" ? null : (int)$width, $width === "" ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $stmt->bindValue(':height', $height === "" ? null : (int)$height, $height === "" ? PDO::PARAM_NULL : PDO::PARAM_INT);
    $stmt->bindValue(':image', $image_path, PDO::PARAM_STR);


    $stmt->execute();

    // -----------------------------
    // 6. 完了メッセージ
    // -----------------------------
    echo "<h2>商品を登録しました！</h2>";
    echo '<a href="../front/product-list.php">商品一覧へ</a>';
    exit;
}

?>
