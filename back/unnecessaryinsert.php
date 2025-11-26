<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
// ------------- DB接続 -------------
$pdo = new PDO($connect, USER, PASS);

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    exit("DB接続に失敗しました：" . $e->getMessage());
}

// ------------- 入力チェック -------------
$errors = [];

if (empty($_POST["name"])) {
    $errors[] = "商品名を入力してください。";
}

if (empty($_POST["price"])) {
    $errors[] = "価格を入力してください。";
} elseif (!preg_match('/^[0-9]+$/', $_POST["price"])) {
    $errors[] = "価格は数字で入力してください。";
}

if (empty($_POST["explain"])) {
    $errors[] = "商品説明を入力してください。";
}

if (empty($_POST["width"])) {
    $errors[] = "横幅を入力してください。";
}

if (empty($_POST["height"])) {
    $errors[] = "高さを入力してください。";
}

// 画像チェック
if (empty($_FILES["image"]["name"])) {
    $errors[] = "画像を選択してください。";
}

// ------------- エラーがある場合は表示して終了 -------------
if (!empty($errors)) {
    foreach ($errors as $e) {
        echo "<p style='color:red;'>$e</p>";
    }
    exit();
}

// ------------- 画像アップロード処理 -------------
$image_name = time() . "_" . $_FILES['image']['name'];  // ユニーク化
$upload_path = "upload/" . $image_name;

if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
    echo "<p style='color:red;'>画像をアップロードできませんでした。</p>";
    exit();
}

// ------------- INSERT処理 -------------
$sql = $pdo->prepare("
    INSERT INTO unnecessary_items
        (unnecessary_items_name, price, unnecessary_items_explain, created_at, width, height, image)
    VALUES
        (?, ?, ?, NOW(), ?, ?, ?)
");

$result = $sql->execute([
    $_POST["name"],
    $_POST["price"],
    $_POST["explain"],
    $_POST["width"],
    $_POST["height"],
    $image_name
]);

// ------------- 成功したら完了画面へ移動 -------------
if ($result) {
    header("Location: complete.php");
    exit();
} else {
    echo "<p style='color:red;'>データの登録に失敗しました。</p>";
}
?>
