<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM master_brand WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: ../views/brand.php");
exit;
