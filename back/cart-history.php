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

// DB接続
require_once 'db_connect.php'; // DB は back 側にあるまま

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

// HTML ヘッダー（front 側から読み込む）
require_once '../front/header.html';
?>

<div class="form-container center">
    <h2>注文履歴</h2>

    <?php if (empty($orders)): ?>
        <p>注文履歴はありません</p>
    <?php else: ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>商品名</th>
                <th>画像</th>
                <th>数量</th>
                <th>合計金額</th>
                <th>注文日</th>
            </tr>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['item_name']) ?></td>
                    <td>
                        <img src="../image/<?= htmlspecialchars($order['item_id']) ?>.png" 
                             alt="<?= htmlspecialchars($order['item_name']) ?>" 
                             width="50">
                    </td>
                    <td><?= htmlspecialchars($order['item_amount']) ?></td>
                    <td><?= htmlspecialchars($order['total_price']) ?>円</td>
                    <td><?= htmlspecialchars($order['order_date']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <!-- ホームに戻るボタン -->
    <div style="margin-top:20px;">
        <a href="../front/home-sample.php">
            <button class="btn-order button">ホームに戻る</button>
        </a>
    </div>
</div>

<?php
// HTML フッターも front 側から読み込む
require_once '../front/footer.html';
?>
