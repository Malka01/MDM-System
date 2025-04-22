<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}
include 'includes/header.php';
require '../config/db.php';

$brands = $pdo->query("SELECT * FROM master_brand ORDER BY created_at DESC")->fetchAll();
?>

<div class="container" style="text-align: center;">
    <h2>Brand Management</h2>

    <form method="POST" action="../controllers/brandController.php" style="margin-bottom: 30px;">
        <input type="text" name="code" placeholder="Brand Code" required>
        <input type="text" name="name" placeholder="Brand Name" required>
        <button type="submit" name="create_brand">Add Brand</button>
    </form>

    <h3>Existing Brands</h3>

    <table class="table" style="margin: 0 auto; text-align: center;">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brands as $brand): ?>
                <tr>
                    <td><?= htmlspecialchars($brand['code']) ?></td>
                    <td><?= htmlspecialchars($brand['name']) ?></td>
                    <td><?= htmlspecialchars($brand['status']) ?></td>
                    <td>
                        <a href="../controllers/editBrandController.php?id=<?= $brand['id'] ?>">Edit</a> |
                        <a href="../controllers/deleteBrandController.php?id=<?= $brand['id'] ?>" onclick="return confirm('Are you sure you want to delete this brand?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../export.php?type=brand" class="btn" style="margin-bottom: 20px; display: inline-block;">Export Brands</a>

</div>
   
   <a href="../views/dashboard.php" class="dashboard-link" style="text-align: left;">Go to Dashboard</a>

<?php include 'includes/footer.php'; ?>
