<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
    exit;
}

if (isset($_POST['create_brand'])) {
    $stmt = $pdo->prepare("INSERT INTO master_brand (code, name, status, created_at, updated_at) VALUES (?, ?, 'Active', NOW(), NOW())");
    $stmt->execute([$_POST['code'], $_POST['name']]);
    header("Location: ../views/brand.php");
}
?>