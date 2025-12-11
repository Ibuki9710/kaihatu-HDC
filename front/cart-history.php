<?php
// エラー表示（開発時のみ）
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// セッション開始（未開始の場合のみ）
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ログインチェック
if (!isset($_SESSION['member_id'])) {
    $_SESSION['error'] = "ログインしてください";
    header('Location: login.php');
    exit;
}

$member_id = $_SESSION['member_id'];

// DB接続（back 側の db_connect.php を使用）
require_once '../back/db_connect.php';

// 注文履歴を取得（cartss テーブル使用）
$stmt = $pdo->prepare("
    SELECT o.order_id, o.item_id, o.item_amount, o.total_price, o.order_date, i.item_name
    FROM cartss o
    JOIN item i ON o.item_id = i.item_id
    WHERE o.member_id = ?
    ORDER BY o.order_date DESC
");
$stmt->execute([$member_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// front 側のヘッダーを読み込む
require 'header.html';
?>

<div class="form-container">
    <div class="center-content">
        <h2>注文履歴</h2>
    </div>

    <?php if (empty($orders)): ?>
        <p>注文履歴はありません</p>
    <?php else: ?>
        <div class="cart-list">
            <?php foreach ($orders as $order): ?>
                <section class="cart-item">
                    <section class="cart-item">
                        <?= htmlspecialchars($order['item_name']) ?>
                        <img src="../image/<?= htmlspecialchars($order['item_id']) ?>.png" 
                             alt="<?= htmlspecialchars($order['item_name']) ?>" 
                             >
                    <div class="info">
                        <p><?= htmlspecialchars($order['item_amount']) ?></p>
                        <p><?= htmlspecialchars($order['total_price']) ?>円</p>
                        <p><?= htmlspecialchars($order['order_date']) ?></p>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- ホームに戻るボタン -->
    <div class="btn-group">
        <a href="javascript:history.back();">
            <button class="btn-base blueBtn white"><a href="home-sample.php">ホームに戻る</button></a>
        </a>
    </div>
</div>

<?php
// front 側のフッターを読み込む
require 'footer.html';
?>
