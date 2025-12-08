<?php
session_start();

require_once __DIR__ . '/db_connect.php';

class ProductModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllProducts() {
        $sql = "SELECT item_id AS id, item_name AS name, item_explain AS description
                FROM item ORDER BY item_id DESC";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function searchProducts($keyword) {
        $search = '%' . $keyword . '%';
        $sql = "SELECT item_id AS id, item_name AS name, item_explain AS description
                FROM item 
                WHERE item_name LIKE ? OR item_explain LIKE ?
                ORDER BY item_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$search, $search]);
        return $stmt->fetchAll();
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM item WHERE item_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}

$model = new ProductModel($pdo);


// =============================
// POST（検索 or 削除）
// =============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 削除
    if (!empty($_POST['action']) && $_POST['action'] === 'delete') {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if ($id && $model->deleteProduct($id)) {
            $_SESSION['message'] = "商品 ID {$id} を削除しました。";
        }
        header("Location: ../front/product-search.php");
        exit;
    }

    // 検索
    if (isset($_POST['keyword'])) {
        $keyword = trim($_POST['keyword']);

        if ($keyword === "") {
            $products = $model->getAllProducts();   // 空検索→全件表示
        } else {
            $products = $model->searchProducts($keyword);
        }

        $_SESSION['products'] = $products;
        header("Location: ../front/product-search.php");
        exit;
    }
}

// =============================
// ここまで来たら 「アクセス不正」
// front から直接 require された可能性がある
// =============================
exit("直接アクセスはできません");
