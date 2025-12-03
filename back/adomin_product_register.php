<?php
// =========================================================
// 1. データベース接続 (db_connect.php を使用)
// =========================================================
// $pdoという名前のPDOオブジェクトが初期化されることを期待します。
require 'db_connect.php'; 

if (!isset($pdo) || !($pdo instanceof PDO)) {
    // 接続ファイルが正しく機能していない場合の致命的なエラー
    die("エラー: データベース接続オブジェクト \$pdo が初期化されていません。db_connect.phpを確認してください。");
}

// 初期メッセージ変数を設定
$success_message = '';
$error_message = '';


// =========================================================
// 2. フォームデータの受け取りと処理
// =========================================================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    
    // --------------------------------------------------------
    // 2-1. データの取得、サニタイズ、バリデーション
    // --------------------------------------------------------
    // **注意:** フロント側で設定された 'name' 属性を使用してデータを受け取ります。
    $product_name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
    $description  = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    
    // 在庫数と無制限フラグの処理
    $is_unlimited = isset($_POST['unlimited_stock']) ? 1 : 0;
    if ($is_unlimited) {
        $stock = -1; // 無制限を示す値
    } else {
        $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
        $stock = ($stock === false || $stock === null) ? 0 : $stock;
    }
    
    // サイズ (横幅と高幅)
    $width  = filter_input(INPUT_POST, 'width', FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
    $height = filter_input(INPUT_POST, 'height', FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
    
    // 公開設定 (ラジオボタン)
    $is_public = filter_input(INPUT_POST, 'is_public', FILTER_VALIDATE_INT);
    $is_public = ($is_public === false || $is_public === null) ? 0 : $is_public;
    

    // --------------------------------------------------------
    // 2-2. 必須項目のチェック
    // --------------------------------------------------------
    if (empty($product_name)) {
        $error_message = "商品名は必須です。";
    } else {
        // --------------------------------------------------------
        // 2-3. 画像ファイルのアップロード処理
        // --------------------------------------------------------
        $image_path = null;
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/product_images/'; // ⬅️ 実際のパスに変更・作成
            
            if (!is_dir($upload_dir)) {
                // ディレクトリ作成失敗時もエラーとしないよう @ を付けることが多い
                @mkdir($upload_dir, 0777, true); 
            }

            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $file_type = $_FILES['product_image']['type']; 

            if (!in_array($file_type, $allowed_types) && !str_starts_with($file_type, 'image/')) {
                $error_message = "許可されていないファイル形式です。JPEG、PNG、GIFのみが許可されます。";
            } elseif ($_FILES['product_image']['size'] > 5000000) { // 5MB制限
                $error_message = "ファイルサイズが大きすぎます。5MB以下にしてください。";
            } else {
                $file_extension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
                $file_name_unique = uniqid('prod_', true) . '.' . $file_extension;
                $target_file = $upload_dir . $file_name_unique;

                if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
                    $image_path = $target_file; 
                } else {
                    $error_message = "ファイルのアップロードに失敗しました。";
                }
            }
        }

        // --------------------------------------------------------
        // 2-4. データベースへの挿入 (プリペアドステートメント)
        // --------------------------------------------------------
        if (empty($error_message)) {
            $sql = "INSERT INTO products (
                        name, description, stock, width, height, image_path, is_public, created_at
                    ) VALUES (
                        :name, :description, :stock, :width, :height, :image_path, :is_public, NOW()
                    )";
            
            try {
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':name'        => $product_name,
                    ':description' => $description,
                    ':stock'       => $stock,
                    ':width'       => $width,
                    ':height'      => $height,
                    ':image_path'  => $image_path,
                    ':is_public'   => $is_public
                ]);
                
                $success_message = "✅ 商品「" . htmlspecialchars($product_name) . "」が正常に登録されました。";
                
                // 成功した場合は、この後のHTML出力前にリダイレクトを推奨します。
                // 例: header('Location: product-list.php?status=success'); exit();

            } catch (\PDOException $e) {
                // DBエラー
                $error_message = "商品の登録に失敗しました (DBエラー): " . $e->getMessage();
            }
        }
    }
}
// =========================================================
// 3. 処理結果の出力 (フロント側へのメッセージ返却)
// =========================================================

// POSTリクエストがあり、結果メッセージがある場合にのみ出力
if (!empty($success_message) || !empty($error_message)) {
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>商品登録結果</title></head><body>';
    
    if (!empty($success_message)) {
        echo '<div style="color: green; padding: 20px; border: 1px solid green; background-color: #e6ffe6;">' . $success_message . '</div>';
    }
    if (!empty($error_message)) {
        echo '<div style="color: red; padding: 20px; border: 1px solid red; background-color: #ffe6e6;">' . $error_message . '</div>';
    }
    
    // 戻るボタンの提供
    echo '<p><a href="javascript:history.back()">登録画面に戻る</a></p>';
    echo '</body></html>';
} else {
    // POSTリクエストがない場合（またはリダイレクトを推奨する場合）
    // 通常、このファイルはフォームからのPOSTでのみアクセスされるべきです。
    // 直接アクセスされた場合は、フォームがあるページへリダイレクトすることが多いです。
    // header('Location: product-register-form.php'); exit();
}

?>