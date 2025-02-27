<?php
require_once '../db.php';
require_once '../models/Product.php';

if (!isset($_GET['id'])) {
    die('Invalid product ID.');
}

$productModel = new Product($pdo);
$product = $productModel->getProductById($_GET['id']);

if (!$product) {
    die('Product not found.');
}
?>

<form method="POST" action="../controllers/ProductController.php?action=edit&id=<?= $product['id'] ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
    <input type="text" name="short_description" value="<?= htmlspecialchars($product['short_description']) ?>" required>
    <textarea name="detailed_description" required><?= htmlspecialchars($product['detailed_description']) ?></textarea>
    <textarea name="specifications"><?= htmlspecialchars($product['specifications']) ?></textarea>
    <textarea name="features"><?= htmlspecialchars($product['features']) ?></textarea>
    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>
    <button type="submit">Update Product</button>
</form>