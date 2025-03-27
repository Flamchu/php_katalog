<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="/katalog/style.css">
</head>

<body>
    <div class="admin-container">
        <header class="admin-header">
            <h1>Admin Panel</h1>
            <nav class="admin-nav">
                <a href="/katalog/admin/manage/product/add" class="btn">Add New Product</a>
                <a href="/katalog/admin/manage/category" class="btn">Manage Categories</a>
                <a href="/katalog/logout" class="btn logout">Logout</a>
            </nav>
        </header>

        <section class="product-list">
            <h2>Products</h2>
            <?php if (empty($products)): ?>
                <p class="no-products">No products found.</p>
            <?php else: ?>
                <table class="product-table">
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
                                    <a href="/katalog/admin/manage/product/edit/<?= $product['id'] ?>" class="btn edit">Edit</a>
                                    <a href="/katalog/delete-product/<?= $product['id'] ?>" class="btn delete"
                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </div>
</body>

</html>