<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
include 'includes/header.php';
require '../config/db.php';

// Fetch all categories
$categories = $pdo->query("SELECT * FROM master_category ORDER BY created_at DESC")->fetchAll();
?>
<div class="container" style="margin: 0 auto; text-align: center;">
    <h2>Category Management</h2>
    <form method="POST" action="../controllers/categoryController.php">
        <input type="text" name="code" placeholder="Category Code" required>
        <input type="text" name="name" placeholder="Category Name" required>
        <button type="submit" name="create_category">Add Category</button>
    </form>
    <h3>Existing Categories</h3>
    <table class="table" style="margin: 0 auto; text-align: center;">
        <tr><th>Code</th><th>Name</th><th>Status</th></tr>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= htmlspecialchars($category['code']) ?></td>
                <td><?= htmlspecialchars($category['name']) ?></td>
                <td><?= htmlspecialchars($category['status']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<a href="../views/dashboard.php" class="dashboard-link" style="text-align: left;">Go to Dashboard</a>

<?php include 'includes/footer.php'; ?>
