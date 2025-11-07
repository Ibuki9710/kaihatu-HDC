<?php
session_start();
require_once 'db_connect.php';

// ログイン確認
if (!isset($_SESSION['customer_id'])) {
    header('Location: ../front/login.php');
    exit;
}

// カート確認
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: ../front/cart.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // トランザクション開始
        $pdo->beginTransaction();

        // 合計金額計算
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 注文テーブルに挿入
        $stmt = $pdo->prepare(
            "INSERT INTO orders (customer_id, total_amount, order_date, status) 
             VALUES (?, ?, NOW(), '処理中')"
        );
        $stmt->execute([$_SESSION['customer_id'], $total]);
        $order_id = $pdo->lastInsertId();

        // 注文詳細テーブルに挿入
        $stmt = $pdo->prepare(
            "INSERT INTO order_details (order_id, item_id, quantity, price) 
             VALUES (?, ?, ?, ?)"
        );

        foreach ($_SESSION['cart'] as $item) {
            $stmt->execute([
                $order_id,
                $item['item_id'],
                $item['quantity'],
                $item['price']
            ]);
        }

        // トランザクションコミット
        $pdo->commit();

        // カートをクリア
        unset($_SESSION['cart']);
        $_SESSION['order_success'] = true;
        $_SESSION['order_id'] = $order_id;

        // 注文完了ページへリダイレクト
        header('Location: ../front/order_complete.php');
        exit;

    } catch (PDOException $e) {
        // エラー時はロールバック
        $pdo->rollBack();
        echo "注文エラー: " . $e->getMessage();
        exit;
    }
}

// 不正なアクセス
header('Location: ../front/cart.php');
exit;