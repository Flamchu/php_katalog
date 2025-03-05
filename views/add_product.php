<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>Add New Product</h1>
    <form action="../controllers/ProductController.php?action=add" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Short Description:</label>
        <input type="text" name="short_description" required>

        <label>Detailed Description:</label>
        <textarea name="detailed_description" required></textarea>

        <label>Specifications:</label>
        <textarea name="specifications"></textarea>

        <label>Features:</label>
        <textarea name="features"></textarea>

        <label>Price:</label>
        <input type="number" name="price" step="0.01" required>

        <label>Category:</label>
        <select name="category_id">
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['id']) ?>">
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add Product</button>
    </form>
</body>

</html>