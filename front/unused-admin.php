<?php
session_start();
require_once __DIR__ . '/../back/db_connect.php';

// -----------------------------
// 削除処理
// -----------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM item WHERE item_id = ?");
            $stmt->execute([$id]);
            $_SESSION['message'] = "商品 ID {$id} を削除しました。";
        } catch (PDOException $e) {
            $_SESSION['message'] = "削除中にエラーが発生しました: " . htmlspecialchars($e->getMessage());
        }
    }

    header("Location: unused-admin.php");
    exit;
}

// -----------------------------
// メッセージ取得
// -----------------------------
$message = '';
if (!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// -----------------------------
// 不用品データ取得
// -----------------------------
try {
    $stmt = $pdo->query("SELECT * FROM item ORDER BY item_id DESC");
    $notitems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $items = [];
    $error_message = "商品取得中にエラーが発生しました: " . htmlspecialchars($e->getMessage());
}

?>

<?php require 'header-admin.html'; ?>
<?php require 'list-admin.html'; ?>

<div class="conteiner-header">
    <h2>不用品管理</h2>

    <?php if ($message !== ''): ?>
        <p style="color: green;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <p style="color:red;"><?= $error_message ?></p>
    <?php endif; ?>

    <?php if (!empty($items)): ?>
        <?php foreach ($items as $item): ?>
            <div class="product-box">
                <img src="../image/mage.png" alt="<?= htmlspecialchars($item['item_name']) ?>" class="product-img">

                <div class="product-info">
                    <p><strong>ID：</strong><?= htmlspecialchars($item['item_id']) ?></p>
                    <p><strong>商品名：</strong><?= htmlspecialchars($item['item_name']) ?></p>
                    <p><strong>価格：</strong><?= htmlspecialchars($item['price']) ?>円</p>
                    <p><strong>説明：</strong><?= htmlspecialchars($item['items_explain']) ?></p>
                    <?php if (!empty($item['width']) && !empty($item['height'])): ?>
                        <p><strong>サイズ：</strong><?= htmlspecialchars($item['width']) ?>cm × <?= htmlspecialchars($item['height']) ?>cm</p>
                    <?php endif; ?>
                    <p><strong>ブランド：</strong><?= htmlspecialchars($item['brand']) ?></p>
                </div>

                <form action="unused-admin.php" method="post" onsubmit="return confirm('本当に削除しますか？');">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($item['item_id']); ?>">
                    <button type="submit" class="btn-base redBtn">削除</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>不用品が見つかりません。</p>
    <?php endif; ?>
</div>

<?php require 'footer-admin.html'; ?>
