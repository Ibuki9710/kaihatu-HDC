<?php
require_once 'db_connect.php';
require_once 'ProductModel.php';

$model = new ProductModel();

$message = '';
$error = '';

// -----------------------------
// 削除処理
// -----------------------------
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id) {
        if ($model->deleteProduct($id)) {
            header('Location: product_admin.php?message=' . urlencode("削除しました"));
            exit;
        }
    }
}

// -----------------------------
// メッセージ
// -----------------------------
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}

// -----------------------------
// 検索処理
// -----------------------------
if (!empty($_GET['keyword'])) {
    $products = $model->searchProducts($_GET['keyword']);
} else {
    $products = $model->getAllProducts();
}
?>

<!-- ここからHTML（VIEW） -->
<?php require 'header-admin.html'; ?>

（商品リスト表示HTML…検索フォームなど）

<?php require 'footer-admin.html'; ?>
