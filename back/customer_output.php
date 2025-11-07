<?php
session_start();
if (!isset($_SESSION['register_success'])) {
    header('Location: ../frontend/customer_input.php');
    exit;
}
unset($_SESSION['register_success']);
