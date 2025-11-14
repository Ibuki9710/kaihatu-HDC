<?php
session_start();
if (!isset($_SESSION['register_success'])) {
    header('Location: ../front/customer.php');
    exit;
}
unset($_SESSION['register_success']);
require 'footer.php';
?>