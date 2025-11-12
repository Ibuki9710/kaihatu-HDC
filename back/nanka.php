<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $pdo=new PDO($connect, USER, PASS);
    $sql = $pdo->prepare("select * from product where brand = '大型製品'");
    $sql->execute();
    
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo '<h1>検索結果1</h1>';
    foreach($sql as $row){
        $id=$row['item_id'];
        echo '<a href="">';
        echo '<img src="', $row['image'], '">';
        echo $row['item_name'];
        echo $row['width'];
        echo $row['height'];
        echo '</a>';
    }
?>

<?php
    $sql = $pdo->prepare("select * from product where brand = '小型製品'");
    $sql->execute();
    
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);

    echo '<h1>検索結果1</h1>';
    foreach($sql as $row){
        $id=$row['item_id'];
        echo '<a href="">';
        echo '<img src="', $row['image'], '">';
        echo $row['item_name'];
        echo $row['width'];
        echo $row['height'];
        echo '</a>';
    }
?>



<?php

try {

    // 2. ユーザー入力の取得とバリデーション
    // 'height'と'width'のフォーム名が正しいと仮定し、isset/null合体演算子で安全に取得
    $target_height = filter_input(INPUT_POST, 'height', FILTER_VALIDATE_INT);
    $target_width = filter_input(INPUT_POST, 'width', FILTER_VALIDATE_INT);
    
    // 3. 検索条件とパラメータの初期設定
    $where_clauses = [];
    $execute_params = [];
    $is_valid_search = false;

    // --- 縦の検索条件設定 ---
    if ($target_height !== null && $target_height !== false) {
        // ±50cmの範囲を計算（最小値は0で制限）
        $h_small = max(0, $target_height - 50);
        $h_max = $target_height + 50;
        
        $where_clauses[] = "height BETWEEN ? AND ?";
        $execute_params[] = $h_small;
        $execute_params[] = $h_max;
        $is_valid_search = true;
    }

    // --- 横の検索条件設定 ---
    if ($target_width !== null && $target_width !== false) {
        $w_small = max(0, $target_width - 50);
        $w_max = $target_width + 50;
        
        $where_clauses[] = "width BETWEEN ? AND ?";
        $execute_params[] = $w_small;
        $execute_params[] = $w_max;
        $is_valid_search = true;
    }

    // 4. SQLの構築と実行
    if ($is_valid_search) {
        $sql = "SELECT * FROM items WHERE " . implode(" AND ", $where_clauses);
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($execute_params);
        
        // 5. 結果の取得
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    // 6. 結果の表示
    echo '<h1>検索結果1</h1>';
    
    if (!empty($results)) {
        foreach($results as $row){
            echo '<a href="">';
            echo '<img src="', htmlspecialchars($row['image']), '">';
            echo htmlspecialchars($row['item_name']);
            echo ' (横: ', htmlspecialchars($row['width']), 'cm, 縦: ', htmlspecialchars($row['height']), 'cm)';
            echo '</a><br>';
        }
    } else if ($is_valid_search) {
         echo "<p>該当する商品が見つかりませんでした。</p>";
    }

} catch (PDOException $e) {
    // データベース接続/実行エラー時の処理
    error_log("DBエラー: " . $e->getMessage());
    echo "<p>システムエラーが発生しました。</p>";
}
?>

