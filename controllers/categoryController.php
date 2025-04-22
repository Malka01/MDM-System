<?php
session_start();
require '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
    exit;
}

// Create Category
if (isset($_POST['create_category'])) {
    $stmt = $pdo->prepare("INSERT INTO master_category (code, name, status, created_at, updated_at) VALUES (?, ?, 'Active', NOW(), NOW())");
    $stmt->execute([$_POST['code'], $_POST['name']]);
    header("Location: ../views/category.php");
    exit;
}

// Edit Category
if (isset($_POST['edit_category'])) {
    $stmt = $pdo->prepare("UPDATE master_category SET code = ?, name = ?, status = ?, updated_at = NOW() WHERE id = ?");
    $stmt->execute([$_POST['code'], $_POST['name'], $_POST['status'], $_POST['id']]);
    header("Location: ../views/category.php");
    exit;
}

// Delete Category
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM master_category WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: ../views/category.php");
    exit;
}
?>
