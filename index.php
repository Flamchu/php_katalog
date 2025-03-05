<?php
require_once 'db.php';
require_once 'models/Category.php';
require_once 'models/Product.php';
$categoryModel = new Category($pdo);
$productModel = new Product($pdo);
$categories = $categoryModel->getAllCategories();

$categoryId = $_GET['category'] ?? null;
$sort = $_GET['sort'] ?? 'name';

if ($categoryId) {
    $products = $productModel->getProductsByCategory($categoryId, $sort);
} else {
    $products = $productModel->getAllProducts($sort);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Category Products</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <ul>
            <?php foreach ($categories as $category): ?>
                <?php if (empty($category['parent_id'])): ?>
                    <li><a href="index.php?category=<?= htmlspecialchars($category['id']) ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </a></li>
                <?php endif; ?>
            <?php endforeach; ?>

            <li><a href="views/login.php">Login</a></li>
            <?php if (isset($_SESSION['admin'])): ?>
                <li><a href="views/admin.php">Admin Panel</a></li>
            <?php endif; ?>

        </ul>
    </nav>
    <h2>Products</h2>
    <form method="GET" action="index.php">
        <input type="hidden" name="category" value="<?= $categoryId ?>">
        <label class="sort-label" for="sort">Sort by:</label>
        <select class="sort-list" name="sort" onchange="this.form.submit()">
            <option value="name" <?= $sort == 'name' ? 'selected' : '' ?>>Name</option>
            <option value="price" <?= $sort == 'price' ? 'selected' : '' ?>>Price</option>
        </select>
    </form>
    <div class="product-list">
        <?php if (empty($products)): ?>
            <p>No products available.</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <h3><a href="controllers/ProductController.php?action=view&id=<?= $product['id'] ?>">
                            <?= htmlspecialchars($product['name']) ?> </a>
                    </h3>
                    <p><?= htmlspecialchars($product['short_description']) ?></p>
                    <p>Price: <?= number_format($product['price'], 2) ?> Kč</p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>