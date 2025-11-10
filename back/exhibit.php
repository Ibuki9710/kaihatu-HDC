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
        header('Location: ../front/exhibit.php');
        exit;
    }

    // 入力値の取得とバリデーション
    $item_name = filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $width = filter_input(INPUT_POST, 'width', FILTER_VALIDATE_INT);
    $height = filter_input(INPUT_POST, 'height', FILTER_VALIDATE_INT);
    $quality = filter_input(INPUT_POST, 'quality', FILTER_SANITIZE_STRING);
    $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);

    $errors = [];

    // バリデーション
    if (empty($item_name)) {
        $errors[] = '商品名を入力してください';
    }

    if (!$price || $price <= 0) {
        $errors[] = '有効な価格を入力してください';
    }

    if (empty($description)) {
        $errors[] = '商品説明を入力してください';
    }

    if (!$width || $width <= 0) {
        $errors[] = '有効な横幅を入力してください';
    }

    if (!$height || $height <= 0) {
        $errors[] = '有効な高さを入力してください';
    }

    if (empty($quality)) {
        $errors[] = '品質を選択してください';
    }

    if (empty($genre)) {
        $errors[] = 'ジャンルを選択してください';
    }

    // 画像のバリデーション
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $max_size = 5 * 1024 * 1024; // 5MB

        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'];

        if (!in_array($file_type, $allowed_types)) {
            $errors[] = '画像はJPEG、PNG、GIF、WebP形式のみアップロード可能です';
        }

        if ($file_size > $max_size) {
            $errors[] = '画像サイズは5MB以下にしてください';
        }

        // エラーがなければ画像を保存
        if (empty($errors)) {
            // アップロードディレクトリの設定
            $upload_dir = '../images/';
            
            // ディレクトリが存在しない場合は作成
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // ファイル名の生成（重複を避けるためにタイムスタンプとランダム文字列を使用）
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $upload_path = $upload_dir . $filename;

            // ファイルを移動
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image_path = $filename; // DBには相対パスのファイル名のみ保存
            } else {
                $errors[] = '画像のアップロードに失敗しました';
            }
        }
    } else {
        $errors[] = '商品画像をアップロードしてください';
    }

    // エラーがある場合は戻る
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header('Location: ../front/exhibit.php');
        exit;
    }

    try {
        $pdo = new PDO($connect, USER, PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // 商品情報をDBに挿入
        $stmt = $pdo->prepare("
            INSERT INTO notitem (
                unnecessary_items_id, 
                unnecessary_items_name, 
                price, 
                unnecessary_items_explain, 
                created_at, 
                width, 
                height, 
                be_solditem, 
                image,
                seller_id,
                created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");

        $stmt->execute([
            $item_name,
            $price,
            $item_stock,
            $description,
            $image_path,
            $width,
            $height,
            $quality,
            $genre,
            $_SESSION['customer_id']
        ]);

        $item_id = $pdo->lastInsertId();

        $_SESSION['success'] = '商品を出品しました';
        $_SESSION['new_item_id'] = $item_id;

        // 出品完了ページへリダイレクト
        header('Location: ../front/exhibit_complete.php');
        exit;

    } catch (PDOException $e) {
        error_log("Exhibit error: " . $e->getMessage());
        
        // 画像ファイルを削除（DB登録に失敗した場合）
        if ($image_path && file_exists($upload_dir . $image_path)) {
            unlink($upload_dir . $image_path);
        }

        $_SESSION['errors'] = ['出品処理中にエラーが発生しました'];
        $_SESSION['form_data'] = $_POST;
        header('Location: ../front/exhibit.php');
        exit;
    }
}

// 直接アクセスされた場合は出品ページへ
header('Location: ../front/exhibit.php');
exit;