<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="/katalog/style.css">
    <style>
        .product-form {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group textarea {
            min-height: 100px;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="product-form">
        <h1>Add New Product</h1>

        <form method="POST" action="/katalog/add-product-action">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="short_description">Short Description:</label>
                <input type="text" id="short_description" name="short_description" required>
            </div>

            <div class="form-group">
                <label for="detailed_description">Detailed Description:</label>
                <textarea id="detailed_description" name="detailed_description" required></textarea>
            </div>

            <div class="form-group">
                <label for="specifications">Specifications:</label>
                <textarea id="specifications" name="specifications"></textarea>
            </div>

            <div class="form-group">
                <label for="features">Features:</label>
                <textarea id="features" name="features"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price (Kč):</label>
                <input type="number" id="price" name="price" step="0.01" min="0" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['id']) ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="submit-btn">Add Product</button>
            <a href="/katalog/admin" class="cancel-btn">Cancel</a>
        </form>
    </div>
</body>

</html>