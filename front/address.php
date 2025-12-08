<?php
ob_start(); // 出力バッファ開始
session_start();
require_once '../back/db_connect.php';

// ログインチェック
if (!isset($_SESSION['member_id'])) {
    $_SESSION['error'] = "ログインしてください";
    header('Location: login.php');
    exit;
}

// POSTがある場合は更新処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member_id = $_SESSION['member_id'];
    $Post_code = $_POST['Post_code'] ?? null;
    $address = trim($_POST['address'] ?? '');

    $errors = [];
    if (empty($Post_code)) $errors[] = "郵便番号を入力してください";
    if (empty($address)) $errors[] = "住所を入力してください";

    if (!empty($errors)) {
        $_SESSION['error'] = implode("<br>", $errors);
        header("Location: address.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            UPDATE customer 
            SET Post_code = ?, address = ?
            WHERE member_id = ?
        ");
        $stmt->execute([$Post_code, $address, $member_id]);

        $_SESSION['success'] = "住所情報を更新しました";
        header("Location: address.php");
        exit;

    } catch (Exception $e) {
        $_SESSION['error'] = "更新に失敗しました: " . $e->getMessage();
        header("Location: address.php");
        exit;
    }
}

// 会員情報取得
$stmt = $pdo->prepare("SELECT Post_code, address FROM customer WHERE member_id = ?");
$stmt->execute([$_SESSION['member_id']]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$member) {
    die('会員情報が見つかりません');
}

$Post_code = $member['Post_code'] ?? '';
$address = $member['address'] ?? '';

require 'header2.html';
?>

<div class="form-container">
    <div class="center-content">
        <h2>お届け先情報の更新</h2>
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

        <form action="address.php" method="post" id="address-form">
            <div class="input-row">
                <label class="input-label" for="zipcode">郵便番号</label>
                <div class="input-field-area">
                    <input type="text" name="Post_code" id="zipcode" maxlength="7" value="<?php echo htmlspecialchars($Post_code); ?>" placeholder="1000001" required>
                    <button type="button" class="menu-btn" onclick="searchZipcode()">検索</button>
                </div>
            </div>

            <div class="input-row">
                <label class="input-label" for="address">住所</label>
                <div class="input-field-area">
                    <input type="text" id="address" name="address" class="input-base-text" value="<?php echo htmlspecialchars($address); ?>" placeholder="市町村番地" required>
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" class="greenBtn btn-base">保存</button>
                <a href="customer-menu.php"><button type="button" class="blueBtn btn-base">戻る</button></a>
            </div>
        </form>
    </div>
</div>

<script>
// 郵便番号から住所を自動入力
async function searchZipcode() {
    const zipcode = document.getElementById('zipcode').value.trim();
    if (!zipcode.match(/^\d{7}$/)) {
        alert("郵便番号は7桁の数字で入力してください");
        return;
    }

    try {
        // 日本郵便 郵便番号検索APIを利用
        const response = await fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${zipcode}`);
        const data = await response.json();

        if (data.status === 200 && data.results) {
            const result = data.results[0];
            const address = result.address1 + result.address2 + result.address3;
            document.getElementById('address').value = address;
        } else {
            alert("住所が見つかりません");
        }

    } catch (error) {
        alert("住所検索でエラーが発生しました");
        console.error(error);
    }
}
</script>

<?php
require 'footer.html';
ob_end_flush();
?>
