<?php
session_start();
require '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
    exit;
}

// Create Item
if (isset($_POST['create_item'])) {
    $stmt = $pdo->prepare("INSERT INTO master_item (code, name, brand_id, category_id, status, created_at, updated_at) VALUES (?, ?, ?, ?, 'Active', NOW(), NOW())");
    $stmt->execute([$_POST['code'], $_POST['name'], $_POST['brand_id'], $_POST['category_id']]);
    header("Location: ../views/item.php");
    exit;
}

// Edit Item
if (isset($_POST['edit_item'])) {
    $stmt = $pdo->prepare("UPDATE master_item SET code = ?, name = ?, brand_id = ?, category_id = ?, status = ?, updated_at = NOW() WHERE id = ?");
    $stmt->execute([$_POST['code'], $_POST['name'], $_POST['brand_id'], $_POST['category_id'], $_POST['status'], $_POST['id']]);
    header("Location: ../views/item.php");
    exit;
}

// Delete Item
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM master_item WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: ../views/item.php");
    exit;
}
?>
