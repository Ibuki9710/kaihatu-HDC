<?php session_start(); ?>
<?php require 'db_connect.php'; ?>
<?php
    $keyword = $_POST['keyword'] ?? '';
    $height = $_POST['height'] ?? null;
    $width = $_POST['width'] ?? null;
    $quality = $_POST['quality'] ?? null;
    $genre = $_POST['genre'] ?? null;
    $pdo=new PDO($connect, USER, PASS);

    $sql = "SELECT * FROM item WHERE 1=1";
    $params = [];

    // キーワード検索
    if (!empty($keyword)) {
        $sql .= " AND item_name LIKE ?";
        $params[] = '%' . $keyword . '%';
    }

    // サイズ検索（高さ）
    if (!empty($height)) {
        $sql .= " AND height >= ?";
        $params[] = $height;
    }

    // サイズ検索（幅）
    if (!empty($width)) {
        $sql .= " AND width >= ?";
        $params[] = $width;
    }

    // 品質フィルター
    if (!empty($quality)) {
        $sql .= " AND quality = ?";
        $params[] = $quality;
    }

    //ジャンル
    if (!empty($genre)) {
        $sql .= " AND genre = ?";
        $params[] = $genre;
    }


    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['items'] = $products;
    echo '<div class="item-list">';
    foreach($products as $row){
        $id=$row['item_id'];
        echo '<div class="item-card">';
        echo '<a href="../front/detail.php?id=', $id, '">';
        echo '<img src="../image/', $id, '.png">';
        echo $row['item_name'];
        echo $row['width'];
        echo $row['height'];
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
?>