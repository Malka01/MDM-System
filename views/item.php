<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
include 'includes/header.php';
require '../config/db.php';

// Fetch brands and categories for dropdowns
$brands = $pdo->query("SELECT * FROM master_brand WHERE status='Active'")->fetchAll();
$categories = $pdo->query("SELECT * FROM master_category WHERE status='Active'")->fetchAll();

// Fetch all items with joins
$items = $pdo->query("SELECT i.*, b.name AS brand, c.name AS category 
                      FROM master_item i
                      JOIN master_brand b ON i.brand_id = b.id
                      JOIN master_category c ON i.category_id = c.id
                      ORDER BY i.created_at DESC")->fetchAll();
?>
<div class="container" style="margin: 0 auto; text-align: center;">
    <h2>Item Management</h2>
    <form method="POST" action="../controllers/itemController.php" style="margin: 0 auto; text-align: center;">
        <input type="text" name="code" placeholder="Item Code" required>
        <input type="text" name="name" placeholder="Item Name" required>
        
        <select name="brand_id" required>
            <option value="">Select Brand</option>
            <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand['id'] ?>"><?= htmlspecialchars($brand['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="create_item">Add Item</button>
    </form>

    <h3>Existing Items</h3>
    <table class="table" style="margin: 0 auto; text-align: center;">
        <tr><th>Code</th><th>Name</th><th>Brand</th><th>Category</th><th>Status</th></tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['code']) ?></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= htmlspecialchars($item['brand']) ?></td>
                <td><?= htmlspecialchars($item['category']) ?></td>
                <td><?= htmlspecialchars($item['status']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<a href="../views/dashboard.php" class="dashboard-link" style="text-align: left;">Go to Dashboard</a>

<?php include 'includes/footer.php'; ?>
