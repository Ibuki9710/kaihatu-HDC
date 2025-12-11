<?php
session_start();
require 'db_connect.php'; // DB接続ファイル

// ログインチェック
if (!isset($_SESSION['member_id'])) {
    $_SESSION['error'] = "ログインしてください";
    header('Location: ../front/login.php');
    exit;
}

// カートチェック
if (empty($_SESSION['cart'])) {
    $_SESSION['error'] = "カートに商品がありません";
    header('Location: ../front/cart.php');
    exit;
}

$member_id = $_SESSION['member_id'];
$cart = $_SESSION['cart'];

try {
    $pdo->beginTransaction();

    foreach ($cart as $item) {
        $item_id = $item['item_id'];
        $item_amount = $item['count'];
        $total_price = $item['price'] * $item_amount;

        $stmt = $pdo->prepare("
            INSERT INTO cartss (member_id, item_id, item_amount, total_price) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$member_id, $item_id, $item_amount, $total_price]);
    }

    // カートを空にする
    $_SESSION['cart'] = [];

    $pdo->commit();

} catch (Exception $e) {
    $pdo->rollBack();
    die("注文処理中にエラーが発生しました: " . $e->getMessage());
}

// 完了メッセージ
?>
<?php require '../front/header.html'; ?>
<div class="form-container center">
    <h2>ご注文が完了しました</h2>
    <p>ご注文ありがとうございました。</p>
    <a href="../front/home-sample.php"><button class="btn-order button">ホームに戻る</button></a>
    <a href="../front/cart-history.php"><button class="btn-order button">注文履歴を見る</button></a>
</div>
<?php require '../front/footer.html'; ?>
