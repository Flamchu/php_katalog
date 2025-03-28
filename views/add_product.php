<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
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
        <div class="form-container">
            <h1>Add New Product</h1>

            <form method="POST" action="/katalog/add-product-action" class="mt-4">
                <div class="form-group">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="short_description" class="form-label">Short Description:</label>
                    <input type="text" id="short_description" name="short_description" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="detailed_description" class="form-label">Detailed Description:</label>
                    <textarea id="detailed_description" name="detailed_description" class="form-control"
                        required></textarea>
                </div>

                <div class="form-group">
                    <label for="specifications" class="form-label">Specifications:</label>
                    <textarea id="specifications" name="specifications" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="features" class="form-label">Features:</label>
                    <textarea id="features" name="features" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Price (Kč):</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="category_id" class="form-label">Category:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['id']) ?>">
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                    <a href="/katalog/admin" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>