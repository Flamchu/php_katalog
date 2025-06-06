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
    <link rel="stylesheet" href="/katalog/style.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <ul class="nav-menu">
                <?php foreach ($categories as $category): ?>
                    <?php if (empty($category['parent_id'])): ?>
                        <li><a href="/katalog/category/<?= htmlspecialchars($category['id']) ?>" class="nav-link">
                                <?= htmlspecialchars($category['name']) ?>
                            </a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="nav-login">
                    <li><a href="/katalog/login" class="nav-link">Login</a></li>
                    <?php if (isset($_SESSION['admin'])): ?>
                        <li><a href="/katalog/admin" class="nav-link">Admin Panel</a></li>
                    <?php endif; ?>
                </div>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="sort-form">
            <label for="sort" class="sort-label">Sort by:</label>
            <select id="sort" name="sort" class="sort-select" onchange="this.form.submit()" aria-label="Sort items by">
                <option value="name" <?= $sort == 'name' ? 'selected' : '' ?>>Name</option>
                <option value="price" <?= $sort == 'price' ? 'selected' : '' ?>>Price</option>
            </select>
        </div>

        <div class="product-list grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <?php if (empty($products)): ?>
                <div class="empty-state col-span-full py-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No products found</h3>
                    <p class="mt-1 text-gray-500">Try adjusting your search or filter criteria</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div
                        class="product-card group relative overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md">
                        <div class="product-content p-4">
                            <h3 class="product-title mb-2 text-lg font-semibold text-gray-900">
                                <a href="/katalog/product/<?= $product['id'] ?>"
                                    class="after:absolute after:inset-0 after:z-10 hover:text-blue-600 focus:outline-none">
                                    <?= htmlspecialchars($product['name']) ?>
                                </a>
                            </h3>
                            <p class="product-description mb-3 text-sm text-gray-600 line-clamp-2">
                                <?= htmlspecialchars($product['short_description']) ?>
                            </p>
                            <p class="product-price text-lg font-bold text-blue-600">
                                <?= number_format($product['price'], 2) ?> Kč
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>