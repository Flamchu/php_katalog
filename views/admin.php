<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

require_once '../db.php';
require_once '../models/Product.php';

$productModel = new Product($pdo);
$products = $productModel->getAllProducts($sort = "name");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h2>Admin Panel</h2>
    <a href="../controllers/ProductController.php?action=showAddForm">Add New Product</a>
    <a href="../controllers/CategoryController.php?action=manage">Manage Categories</a>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?= htmlspecialchars($product['name']) ?> - <?= number_format($product['price'], 2) ?> Kč
                <a href="edit_product.php?id=<?= $product['id'] ?>">Edit</a>
                <a href="../controllers/ProductController.php?action=delete&id=<?= $product['id'] ?>"
                    onclick="return confirm('Are you sure?')">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>