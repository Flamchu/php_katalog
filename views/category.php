<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Products</title>
    <link rel="stylesheet" href="/katalog/style.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="/katalog/">Home</a></li>
            <?php foreach ($categories as $category): ?>
                <?php if (empty($category['parent_id'])): ?>
                    <li><a href="/katalog/category/<?= htmlspecialchars($category['id']) ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            <li><a href="/katalog/login">Login</a></li>
        </ul>
    </nav>

    <?php if ($categoryId): ?>
        <div class="subcategories">
            <h2>Subcategories</h2>
            <ul>
                <?php foreach ($subcategories as $subcategory): ?>
                    <li><a href="/katalog/category/<?= $subcategory['id'] ?>">
                            <?= htmlspecialchars($subcategory['name']) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <h2>Products</h2>

        <form method="GET" action="">
            <input type="hidden" name="category" value="<?= $categoryId ?>">
            <label class="sort-label" for="sort">Sort by:</label>
            <select class="sort-list" name="sort" onchange="this.form.submit()">
                <option value="name" <?= $sort == 'name' ? 'selected' : '' ?>>Name</option>
                <option value="price" <?= $sort == 'price' ? 'selected' : '' ?>>Price</option>
            </select>
        </form>

        <div class="product-list">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <h3><a href="/katalog/product/<?= $product['id'] ?>">
                                <?= htmlspecialchars($product['name']) ?></a></h3>
                        <p><?= htmlspecialchars($product['short_description']) ?></p>
                        <p>Price: <?= number_format($product['price'], 2) ?> Kč</p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found in this category.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p>Please select a category.</p>
    <?php endif; ?>
</body>

</html>