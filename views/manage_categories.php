<!DOCTYPE html>
<html>

<head>
    <title>Category Management</title>
</head>

<body>
    <a href="#" id="addCategoryBtn">Add New Category</a>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li>
                <?= htmlspecialchars($category['name']) ?>
                <a href="../controllers/CategoryController.php?action=delete&id=<?= $category['id'] ?>"
                    onclick="return confirm('Are you sure?')">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <script>
        document.getElementById('addCategoryBtn').addEventListener('click', function (event) {
            event.preventDefault();
            const categoryName = prompt('Enter category name:');
            if (categoryName) {
                window.location.href = `../controllers/CategoryController.php?action=add&name=${encodeURIComponent(categoryName)}`;
            }
        });
    </script>
</body>

</html>