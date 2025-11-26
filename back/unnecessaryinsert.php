<?php
session_start();

// 入力チェック
if (empty($_POST['name']))    $errors[] = "商品名が入力されていません。";
if (empty($_POST['price']))   $errors[] = "価格が入力されていません。";
if (empty($_POST['explain'])) $errors[] = "商品説明が入力されていません。";
if (empty($_POST['width']))   $errors[] = "横幅(mm)が入力されていません。";
if (empty($_POST['height']))  $errors[] = "高さ(mm)が入力されていません。";
if (empty($_FILES['image']['name'])) $errors[] = "画像が選択されていません。";

// エラーが1つでもあれば表示して終了
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red; font-weight:bold;'>※ $error</p>";
    }
    echo "<br><a href='exhibit_form.php'>戻る</a>";
    exit();
}

// フォーム値を受け取り
$name    = $_POST['name'];
$price   = $_POST['price'];
$explain = $_POST['explain'];
$width   = $_POST['width'];
$height  = $_POST['height'];

// 画像保存処理
$image_name = time() . "_" . $_FILES['image']['name'];  // ファイル名をユニーク化
$upload_path = "upload/" . $image_name;

if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
    echo "画像をアップロードできませんでした。";
    exit();
}

// DB接続
$pdo = new PDO(
    'mysql:host=localhost;dbname=shop;charset=utf8',
    'staff',
    'password'
);

// INSERT実行
$sql = $pdo->prepare("
    INSERT INTO unnecessary_items
    (unnecessary_items_name, price, unnecessary_items_explain, created_at, width, height, image)
    VALUES
    (?, ?, ?, NOW(), ?, ?, ?)
");

$sql->execute([
    $name,
    $price,
    $explain,
    $width,
    $height,
    $image_name
]);

// 完了画面へ移動
header("Location: exhibit_done.php");
exit();

?>