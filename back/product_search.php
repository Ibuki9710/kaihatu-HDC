<?php
// ===============================================
// 1. 外部ファイルの読み込み (DbConnect.php)
// ===============================================
// 既存の DbConnect.php が存在し、DB接続ロジックを持っていることを前提とします。
require_once 'db_connect.php'; 

// ===============================================
// 2. 商品操作クラス (ProductModel)
// ===============================================
class ProductModel {
    private $pdo;

    public function __construct() {
        // 外部の DbConnect クラスを利用して PDO インスタンスを取得
        $db = new Dbconnect();
        $this->pdo = $db->connect();
    }

    // R (Read) - 全ての商品を取得
    public function getAllProducts() {
        $stmt = $this->pdo->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    // R (Read/Search) - 検索キーワードに基づいて商品を取得
    public function searchProducts($keyword) {
        $search_term = '%' . $keyword . '%';
        $sql = "SELECT * FROM products 
                WHERE name LIKE ? OR description LIKE ?
                ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$search_term, $search_term]);
        return $stmt->fetchAll();
    }

    // D (Delete) - 商品を削除
    public function deleteProduct($id) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

// ===============================================
// 3. メイン処理 (削除とデータ取得)
// ===============================================

$model = new ProductModel();
$products = [];
$search_keyword = '';
$message = '';
$error = '';

// ----------------------------------------
// 3-1. 削除処理 (Delete)
// ----------------------------------------
//if (isset($_POST['action']) && $_POST['action'] === 'delete') {
  //  $product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
//
    //if ($product_id !== false && $product_id !== null) {
    //    if ($model->deleteProduct($product_id)) {
    //        $message = '✅ 商品ID: ' . $product_id . ' が正常に削除されました。';
            // 削除後のリダイレクト（パラメータ除去とメッセージ表示のため）
    //        header('Location: product_admin.php?message=' . urlencode($message));
    //        exit;
    //    } else {
    //        $error = '❌ 削除に失敗しました。';
    //    }
   // } else {
    //    $error = '❌ 削除対象のIDが無効です。';
  //  }
//}

// ----------------------------------------
// 3-2. メッセージの受け取り
// ----------------------------------------
if (isset($_POST['message'])) {
    $message = htmlspecialchars($_POST['message']);
}

// ----------------------------------------
// 3-3. 商品一覧・検索データ取得処理 (Read/Search)
// ----------------------------------------
if (isset($_POST['keyword']) && $_POST['keyword'] !== '') {
    $search_keyword = filter_input(INPUT_POST, 'keyword', FILTER_SANITIZE_STRING);
    $products = $model->searchProducts($search_keyword); 
} else {
    $products = $model->getAllProducts();
}
?>