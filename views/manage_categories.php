<!DOCTYPE html>
<html>

<head>
    <title>Category Management</title>
    <link rel="stylesheet" href="/katalog/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <ul class="nav-menu">
                <li><a href="/katalog/admin" class="nav-link">Back to Admin</a></li>
                <li><a href="/katalog/logout" class="nav-link">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="admin-panel">
            <h2>Manage Categories</h2>

            <div class="mt-4">
                <h3>Add Category</h3>
                <form action="/katalog/add-category-action" method="POST" class="mt-2">
                    <div class="form-group">
                        <label for="categoryName" class="form-label">Category Name:</label>
                        <input type="text" id="categoryName" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="parentCategory" class="form-label">Parent Category (optional):</label>
                        <select id="parentCategory" name="parent_id" class="form-control">
                            <option value="">None</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category['id']) ?>">
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>

            <div class="mt-5">
                <h3>Existing Categories</h3>
                <table class="data-table mt-2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= htmlspecialchars($category['name']) ?></td>
                                <td>
                                    <a href="/katalog/delete-category/<?= $category['id'] ?>" class="btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>