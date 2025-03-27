<!DOCTYPE html>
<html>

<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="/katalog/style.css">
</head>

<body>
    <h1>Edit Product</h1>

    <form method="POST" action="/katalog/admin/manage/product/edit/<?= $product['id'] ?>">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="short_description">Short Description:</label>
            <input type="text" id="short_description" name="short_description"
                value="<?= htmlspecialchars($product['short_description'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="detailed_description">Detailed Description:</label>
            <textarea id="detailed_description" name="detailed_description" required><?=
                htmlspecialchars($product['detailed_description'] ?? '')
                ?></textarea>
        </div>

        <div class="form-group">
            <label for="specifications">Specifications:</label>
            <textarea id="specifications" name="specifications"><?=
                htmlspecialchars($product['specifications'] ?? '')
                ?></textarea>
        </div>

        <div class="form-group">
            <label for="features">Features:</label>
            <textarea id="features" name="features"><?=
                htmlspecialchars($product['features'] ?? '')
                ?></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price"
                value="<?= htmlspecialchars($product['price'] ?? 0) ?>" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= ($category['id'] == ($product['category_id'] ?? null)) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="submit-btn">Update Product</button>
        <a href="/katalog/admin" class="cancel-btn">Cancel</a>
    </form>
</body>

</html>