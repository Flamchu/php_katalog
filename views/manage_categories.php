<!DOCTYPE html>
<html>

<head>
    <title>Category Management</title>
    <link rel="stylesheet" href="/katalog/style.css">
</head>

<body>
    <h2>Manage Categories</h2>

    <h3>Add Category</h3>
    <form action="/katalog/add-category-action" method="POST">
        <label for="categoryName">Category Name:</label>
        <input type="text" id="categoryName" name="name" required>

        <label for="parentCategory">Parent Category (optional):</label>
        <select id="parentCategory" name="parent_id">
            <option value="">None</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['id']) ?>">
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add Category</button>
    </form>

    <h3>Existing Categories</h3>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li>
                <?= htmlspecialchars($category['name']) ?>
                <a href="/katalog/delete-category/<?= $category['id'] ?>"
                    onclick="return confirm('Are you sure?')">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <p><a href="/katalog/admin">Back to Admin</a></p>
</body>

</html>