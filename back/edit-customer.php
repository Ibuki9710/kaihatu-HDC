<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'header2.html';
require_once 'db_connect.php';

// ログインチェック
if (!isset($_SESSION['member_id'])) {
    $_SESSION['error'] = "ログインしてください";
    header('Location: login.php');
    exit;
}

// 会員情報取得
$stmt = $pdo->prepare("SELECT * FROM customer WHERE member_id = ?");
$stmt->execute([$_SESSION['member_id']]);
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
        if (!empty($_SESSION['error'])) {
            echo '<p style="color:red;">'.$_SESSION['error'].'</p>';
            unset($_SESSION['error']);
        }
        if (!empty($_SESSION['success'])) {
            echo '<p style="color:green;">'.$_SESSION['success'].'</p>';
            unset($_SESSION['success']);
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
        </form>
    </div>
</div>

<?php require 'footer.html'; ?>
