<!DOCTYPE html>
<html>

<head>
    <title>Category Management</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h2>Manage Categories</h2>

    <h3>Add Category</h3>
    <form action="../controllers/CategoryController.php?action=add" method="POST">
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


    <ul>
        <?php foreach ($categories as $category): ?>
            <li>
                <?= htmlspecialchars($category['name']) ?>
                <a href="../controllers/CategoryController.php?action=delete&id=<?= $category['id'] ?>"
                    onclick="return confirm('Are you sure?')">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>