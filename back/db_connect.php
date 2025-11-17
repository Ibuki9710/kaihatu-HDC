<?php
const SERVER = 'mysql326.phy.lolipop.lan';
const DBNAME = 'LAA1607635-hdc';
const USER = 'LAA1607635';
const PASS = 'team05';

try {
    $pdo = new PDO(
        'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',
        USER,
        PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'DB接続エラー: ' . $e->getMessage();
    exit;
}
?>
