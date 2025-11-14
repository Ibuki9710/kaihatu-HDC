<?php
session_start();
require_once 'db_connect.php';

// ログインチェック
if (!isset($_SESSION['customer_id'])) {
    $_SESSION['error'] = 'ログインしてください';
    header('Location: ../front/login.php');
    exit;
}

// CSRF対策
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRFトークン検証
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = 'Invalid request';
        header('Location: ../front/home.php');
        exit;
    }

    $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
    $redirect_url = $_POST['redirect_url'] ?? '../front/home.php';

    if (!$item_id) {
        $_SESSION['error'] = '無効な商品IDです';
        header('Location: ' . $redirect_url);
        exit;
    }

    try {
        $pdo = new PDO($connect, USER, PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // トランザクション開始
        $pdo->beginTransaction();

        // 商品情報を取得（出品者の確認と画像パスの取得）
        $stmt = $pdo->prepare("
            SELECT item_id, seller_id, image 
            FROM item 
            WHERE item_id = ?
        ");
        $stmt->execute([$item_id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$item) {
            throw new Exception('商品が見つかりません');
        }

        // 出品者本人または管理者のみ削除可能
        if ($item['seller_id'] != $_SESSION['customer_id']) {
            throw new Exception('この商品を削除する権限がありません');
        }

        // 関連データの削除チェック
        
        // 1. カート内にこの商品があるか確認
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as count 
            FROM cart 
            WHERE item_id = ?
        ");
        $stmt->execute([$item_id]);
        $cart_count = $stmt->fetchColumn();

        // カート内の商品を削除（オプション：エラーにする場合はコメントアウト）
        if ($cart_count > 0) {
            $stmt = $pdo->prepare("DELETE FROM cart WHERE item_id = ?");
            $stmt->execute([$item_id]);
        }

        // 2. 注文履歴に含まれているか確認
        $stmt = $pdo->prepare("
            SELECT COUNT(*) as count 
            FROM order_details 
            WHERE item_id = ?
        ");
        $stmt->execute([$item_id]);
        $order_count = $stmt->fetchColumn();

        if ($order_count > 0) {
            // 注文履歴がある場合は論理削除（削除フラグを立てる）
            // または、エラーを返す
            throw new Exception('この商品は注文履歴に含まれているため削除できません');
            
            // 論理削除する場合は以下のコードを使用:
            /*
            $stmt = $pdo->prepare("
                UPDATE item 
                SET item_stock = 0, 
                    is_deleted = 1,
                    deleted_at = NOW()
                WHERE item_id = ?
            ");
            $stmt->execute([$item_id]);
            */
        }

        // 3. お気に入りから削除
        $stmt = $pdo->prepare("DELETE FROM favorites WHERE item_id = ?");
        $stmt->execute([$item_id]);

        // 4. レビューを削除
        $stmt = $pdo->prepare("DELETE FROM reviews WHERE item_id = ?");
        $stmt->execute([$item_id]);

        // 5. 商品を削除
        $stmt = $pdo->prepare("DELETE FROM item WHERE item_id = ?");
        $stmt->execute([$item_id]);

        // トランザクションコミット
        $pdo->commit();

        // 画像ファイルの削除
        if (!empty($item['image'])) {
            $image_path = '../images/' . $item['image'];
            if (file_exists($image_path)) {
                if (!unlink($image_path)) {
                    // 画像削除に失敗してもエラーにはしない（ログに記録）
                    error_log("Failed to delete image: " . $image_path);
                }
            }
        }

        $_SESSION['success'] = '商品を削除しました';
        
        // 削除元のページにリダイレクト
        header('Location: ' . $redirect_url);
        exit;

    } catch (Exception $e) {
        // ロールバック
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        
        error_log("Delete item error: " . $e->getMessage());
        $_SESSION['error'] = $e->getMessage();
        header('Location: ' . $redirect_url);
        exit;
    }
}

// POSTリクエスト以外は拒否
$_SESSION['error'] = '不正なアクセスです';
header('Location: ../front/home.php');
exit;