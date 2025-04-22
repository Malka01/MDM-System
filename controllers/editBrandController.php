<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Invalid brand ID";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM master_brand WHERE id = ?");
$stmt->execute([$id]);
$brand = $stmt->fetch();

if (!$brand) {
    echo "Brand not found";
    exit;
}

if (isset($_POST['update_brand'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status = $_POST['status'];

    $updateStmt = $pdo->prepare("UPDATE master_brand SET code = ?, name = ?, status = ?, updated_at = NOW() WHERE id = ?");
    $updateStmt->execute([$code, $name, $status, $id]);

    header("Location: ../views/brand.php");
    exit;
}
?>