<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/katalog/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <ul class="nav-menu">
                <li><a href="/katalog/" class="nav-link">View Site</a></li>
                <li><a href="/katalog/logout" class="nav-link">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="admin-panel">
            <header class="admin-header">
                <h1>Admin Panel</h1>
                <div class="admin-nav">
                    <a href="/katalog/admin/manage/product/add" class="btn btn-primary">Add New Product</a>
                    <a href="/katalog/admin/manage/category" class="btn btn-secondary">Manage Categories</a>
                </div>
            </header>

            <section class="mt-4">
                <h2>Products</h2>
                <?php if (empty($products)): ?>
                    <div class="empty-state">
                        <p>No products found.</p>
                    </div>
                <?php else: ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= htmlspecialchars($product['name']) ?></td>
                                    <td><?= number_format($product['price'], 2) ?> Kč</td>
                                    <td class="actions">
                                        <a href="/katalog/admin/manage/product/edit/<?= $product['id'] ?>"
                                            class="btn btn-primary">Edit</a>
                                        <a href="/katalog/delete-product/<?= $product['id'] ?>" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </section>
        </div>
    </div>
</body>

</html>