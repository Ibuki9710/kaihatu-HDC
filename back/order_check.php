<?php
session_start();
if (!isset($_SESSION['order_total'])) {
    header('Location: ../front/cart.php');
    exit;
}
