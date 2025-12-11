<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
ob_start();
require_once __DIR__ . '/../back/db_connect.php'; // パスは環境に合わせて調整
require 'header2.html';

// ログインチェック
if (!isset($_SESSION['member_id'])) {
    $_SESSION['error_member'] = "ログインしてください";
    header('Location: login.php');
    exit;
}

$member_id = $_SESSION['member_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // =======================
    // 更新処理
    // =======================
    $member_email = $_POST['member_email'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';
    $birth_year = $_POST['birth_year'] ?? null;
    $birth_month = $_POST['birth_month'] ?? null;
    $birth_day = $_POST['birth_day'] ?? null;
    $BuySelect = $_POST['BuySelect'] ?? '';

    $errors = [];
    if (empty($member_email)) $errors[] = "メールアドレスを入力してください";
    if (empty($name)) $errors[] = "氏名を入力してください";
    if (empty($birth_year) || empty($birth_month) || empty($birth_day)) $errors[] = "生年月日を入力してください";
    if (empty($BuySelect)) $errors[] = "支払方法を選択してください";

    if (!empty($errors)) {
        $_SESSION['error_member'] = implode("<br>", $errors);
        header("Location: customer-update.php");
        exit;
    }

    try {
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("
                UPDATE customer 
                SET member_email = ?, password = ?, name = ?, birth_year = ?, birth_month = ?, birth_day = ?, BuySelect = ?
                WHERE member_id = ?
            ");
            $stmt->execute([$member_email, $hashed, $name, $birth_year, $birth_month, $birth_day, $BuySelect, $member_id]);
        } else {
            $stmt = $pdo->prepare("
                UPDATE customer 
                SET member_email = ?, name = ?, birth_year = ?, birth_month = ?, birth_day = ?, BuySelect = ?
                WHERE member_id = ?
            ");
            $stmt->execute([$member_email, $name, $birth_year, $birth_month, $birth_day, $BuySelect, $member_id]);
        }

        $_SESSION['success_member'] = "会員情報を更新しました";
        header("Location: customer-update.php");
        exit;

    } catch (Exception $e) {
        $_SESSION['error_member'] = "更新に失敗しました: " . $e->getMessage();
        header("Location: customer-update.php");
        exit;
    }

} else {
    // =======================
    // フォーム表示
    // =======================
    $stmt = $pdo->prepare("SELECT * FROM customer WHERE member_id = ?");
    $stmt->execute([$member_id]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$member) {
        die('会員情報が見つかりません');
    }

    // 生年月日
    $year = $member['birth_year'] ?? '';
    $month = $member['birth_month'] ?? '';
    $day = $member['birth_day'] ?? '';
    ?>

    <div class="form-container">
        <div class="center-content">
            <h2>会員情報の確認・変更</h2>
        </div>

        <div class="center">
            <?php
            // 会員情報専用のメッセージを表示
            if (!empty($_SESSION['error_member'])) {
                echo '<p style="color:red;">'.$_SESSION['error_member'].'</p>';
                unset($_SESSION['error_member']);
            }
            if (!empty($_SESSION['success_member'])) {
                echo '<p style="color:green;">'.$_SESSION['success_member'].'</p>';
                unset($_SESSION['success_member']);
            }
            ?>

            <form action="customer-update.php" method="post">
                <div class="input-row">
                    <label>メールアドレス（必須）</label>
                    <input type="email" name="member_email" value="<?php echo htmlspecialchars($member['member_email']); ?>" required>
                </div>

                <div class="input-row">
                    <label>パスワード（任意）</label>
                    <input type="password" name="password" placeholder="変更する場合のみ入力">
                </div>

                <div class="input-row">
                    <label>氏名（必須）</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required>
                </div>

                <div class="input-row">
                    <label>生年月日（必須）</label>
                    <select name="birth_year" required>
                        <option value="">年</option>
                        <?php for($y=date('Y'); $y>=1900; $y--): ?>
                            <option value="<?php echo $y; ?>" <?php if($y==$year) echo 'selected'; ?>><?php echo $y; ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="birth_month" required>
                        <option value="">月</option>
                        <?php for($m=1; $m<=12; $m++): ?>
                            <option value="<?php echo $m; ?>" <?php if($m==$month) echo 'selected'; ?>><?php echo $m; ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="birth_day" required>
                        <option value="">日</option>
                        <?php for($d=1; $d<=31; $d++): ?>
                            <option value="<?php echo $d; ?>" <?php if($d==$day) echo 'selected'; ?>><?php echo $d; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="input-row">
                    <label>支払方法（必須）</label>
                    <select name="BuySelect" required>
                        <option value="" disabled <?php if(empty($member['BuySelect'])) echo 'selected'; ?>>選択してください</option>
                        <option value="paypay" <?php if($member['BuySelect']=='paypay') echo 'selected'; ?>>PayPay</option>
                        <option value="credit" <?php if($member['BuySelect']=='credit') echo 'selected'; ?>>クレジットカード</option>
                    </select>
                </div>

                <button type="submit">変更</button>
                <a href="javascript:history.back();">
                    <button class="btn-base blueBtn">戻る</button>
                </a>
            </form>
        </div>
    </div>

    <?php
    require 'footer.html';
    ob_end_flush();
}
