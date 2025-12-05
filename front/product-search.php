<?php 
require 'header-admin.html';
require 'list-admin.html';
?>
<div class="conteiner-header">
    <h2>商品管理</h2>
    <p>商品登録</p>
</div>

<div class="admin-main">
    <!-- 検索フォーム -->
    <form action="product-search.php" method="post">
        <div class="form-container">
            <div class="input-row">
                <input type="text" name="" class="input-base-text" placeholder="商品"> 
            </div>
            <div class="center">
                <button type="submit" class="btn-base btn-wrapper blueBtn">
                    検索
                </button>
            </div>
        </div>
    </form>

    <div class="conteiner-admin center">
        <h2>検索結果</h2>
    </div>

    <!-- カテゴリリンク -->
    <div class="conteiner-admin">
        <a href="product-search.php" class="black">すべて</a>
        <a href="product-search.php" class="black">公開</a>
        <a href="product-search.php" class="black">非公開</a>
        <a href="product-search.php" class="black">不用品</a>
        <a href="product-search.php" class="black">在庫なし</a>
    </div>
    <div class="conteiner-admin">

    <!-- 検索結果テーブル -->
    <div class="conteiner-admin grey align" style="padding:20px;">

        <?php if (!empty($products)): ?>
            <table class="admin-table">
                <tr>
                    <th>ID</th>
                    <th>商品名</th>
                    <th>説明</th>
                    <th>操作</th>
                </tr>

                <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['id']) ?></td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= htmlspecialchars($p['description']) ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="btn-base redBtn">削除</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        <?php else: ?>
            <p>商品が見つかりません。</p>
        <?php endif; ?>
    </div>
</div>

<?php require 'footer-admin.html'; ?>
