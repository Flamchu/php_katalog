<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($product['name']) ? htmlspecialchars($product['name']) : 'Produkt neexistuje' ?> - Detail</title>
    <link rel="stylesheet" href="/katalog/style.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <ul class="nav-menu">
                <li><a href="/katalog/" class="nav-link">Home</a></li>
                <?php foreach ($categories as $category): ?>
                    <?php if (empty($category['parent_id'])): ?>
                        <li><a href="/katalog/category/<?= htmlspecialchars($category['id']) ?>" class="nav-link">
                                <?= htmlspecialchars($category['name']) ?>
                            </a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="nav-login">
                    <li><a href="/katalog/login" class="nav-link">Login</a></li>
                    <?php if (isset($_SESSION['admin'])): ?>
                        <li><a href="/katalog/admin" class="nav-link">Admin Panel</a></li>
                    <?php endif; ?>
                </div>
            </ul>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <?php if (isset($product) && $product): ?>
            <div class="product-detail bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($product['name']) ?></h1>
                    <p class="product-price text-2xl font-semibold text-blue-600">
                        <?= number_format($product['price'], 2) ?> Kč
                    </p>
                </div>

                <div class="gap-8 p-6">
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-3 pb-2 border-b border-gray-200">Detailed
                                Description</h2>
                            <p class="text-gray-700 whitespace-pre-line">
                                <?= htmlspecialchars($product['detailed_description']) ?>
                            </p>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-3 pb-2 border-b border-gray-200">
                                Specifications</h2>
                            <div class="text-gray-700 whitespace-pre-line">
                                <?= htmlspecialchars($product['specifications']) ?>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-3 pb-2 border-b border-gray-200">Features</h2>
                            <div class="text-gray-700 whitespace-pre-line"><?= htmlspecialchars($product['features']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-state text-center py-20">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-xl font-medium text-gray-900">Produkt nebyl nalezen</h3>
                <p class="mt-2 text-gray-600">The product you're looking for doesn't exist or has been removed.</p>
                <a href="/katalog"
                    class="mt-6 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Back to Catalog
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>