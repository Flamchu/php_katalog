<?php
require_once '../models/Category.php';

$categoryModel = new Category($pdo);

$categories = $categoryModel->getAllCategories();
$categoryId = $_GET['category'] ?? null;
?>


<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title><?= isset($product['name']) ? htmlspecialchars($product['name']) : 'Produkt neexistuje' ?> - Detail</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="../">Home</a></li>
            <?php foreach ($categories as $category): ?>
                <?php if (empty($category['parent_id'])): ?>
                    <li><a href="../views/category.php?category=<?= htmlspecialchars($category['id']) ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            <li><a href="views/login.php">Login</a></li>
        </ul>
    </nav>

    <?php if ($product): ?>
        <div class="product-detail">
            <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
            <p class="product-price"><strong>Price:</strong> <?= htmlspecialchars($product['price']) ?> Kč</p>
            <h2 class="product-description-title">Detailed description</h2>
            <p class="product-description"><?= nl2br(htmlspecialchars($product['detailed_description'])) ?></p>
            <h2 class="product-description-title">Specifications</h2>
            <p class="product-description"><?= nl2br(htmlspecialchars($product['specifications'])) ?></p>
            <h2 class="product-description-title">Features</h2>
            <p class="product-description"><?= nl2br(htmlspecialchars($product['features'])) ?></p>
        </div>
    <?php else: ?>
        <p class="product-not-found">Produkt nebyl nalezen.</p>
    <?php endif; ?>
</body>

</html>