<!DOCTYPE html>
<html>
<head>
    <title>Edit Brand</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Brand</h2>
        <form method="POST">
            <input type="text" name="code" value="<?= htmlspecialchars($brand['code']) ?>" required>
            <input type="text" name="name" value="<?= htmlspecialchars($brand['name']) ?>" required>
            <select name="status">
                <option value="Active" <?= $brand['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $brand['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
            <button type="submit" name="update_brand">Update Brand</button>
        </form>
        <a href="brand.php">Back to Brand List</a>
    </div>
</body>
</html>