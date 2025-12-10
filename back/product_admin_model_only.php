<?php
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
