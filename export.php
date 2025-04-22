<?php
require 'config/db.php';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="items.csv"');
$output = fopen("php://output", "w");
fputcsv($output, ['ID', 'Code', 'Name', 'Brand', 'Category', 'Status']);
$query = $pdo->query("SELECT i.id, i.code, i.name, b.name AS brand, c.name AS category, i.status FROM master_item i JOIN master_brand b ON i.brand_id = b.id JOIN master_category c ON i.category_id = c.id");
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, $row);
}
fclose($output);
?>