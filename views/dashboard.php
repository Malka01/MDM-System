<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
include 'includes/header.php';
require '../config/db.php';

// Fetch counts from the database
$totalBrands = $pdo->query("SELECT COUNT(*) FROM master_brand")->fetchColumn();
$totalCategories = $pdo->query("SELECT COUNT(*) FROM master_category")->fetchColumn();
$totalItems = $pdo->query("SELECT COUNT(*) FROM master_item")->fetchColumn();
?>

<!-- Logout Top Right -->
<div class="top-bar" style="position: absolute; top: 10px; right: 10px;">
    <a href="../logout.php" class="logout-link">Logout</a>
</div>

<!-- Dashboard Content -->
<div class="container" style="text-align: center; padding-top: 60px;">
    <h2>Dashboard</h2>
    <p>Welcome! You are logged in.</p>

    <!-- Summary Table -->
    <table style="margin: 20px auto; border-collapse: collapse; width: 50%;">
        <tr>
            <th style="border: 1px solid #ccc; padding: 10px;">Module</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Total Records</th>
            <th style="border: 1px solid #ccc; padding: 10px;">Action</th>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc; padding: 10px;">Brands</td>
            <td style="border: 1px solid #ccc; padding: 10px;"><?= $totalBrands ?></td>
            <td style="border: 1px solid #ccc; padding: 10px;"><a href="brand.php">Manage</a></td>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc; padding: 10px;">Categories</td>
            <td style="border: 1px solid #ccc; padding: 10px;"><?= $totalCategories ?></td>
            <td style="border: 1px solid #ccc; padding: 10px;"><a href="category.php">Manage</a></td>
        </tr>
        <tr>
            <td style="border: 1px solid #ccc; padding: 10px;">Items</td>
            <td style="border: 1px solid #ccc; padding: 10px;"><?= $totalItems ?></td>
            <td style="border: 1px solid #ccc; padding: 10px;"><a href="item.php">Manage</a></td>
        </tr>
    </table>

    <!-- Export Button -->
</div>

<?php include 'includes/footer.php'; ?>
