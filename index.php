<?php
require __DIR__ . '/Router.php';
require __DIR__ . '/db.php';
require __DIR__ . '/models/Category.php';
require __DIR__ . '/models/Product.php';
require __DIR__ . '/controllers/ProductController.php';
require __DIR__ . '/controllers/CategoryController.php';
require __DIR__ . '/controllers/LoginController.php';

$router = new Router();

$categoryController = new CategoryController($pdo);
$productController = new ProductController($pdo);
$loginController = new LoginController($pdo);

$router->addRoute('', function () use ($pdo) {
    require __DIR__ . '/views/home.php';
});

$router->addRoute('/product/{id}', function ($params) use ($productController) {
    $productId = $params['id'];
    $productController->showProduct($productId);
});

$router->addRoute('/category/{id}', function ($params) use ($categoryController) {
    $categoryId = $params['id'];
    $categoryController->showCategory($categoryId);
});

$router->addRoute('/login', function () use ($loginController) {
    $loginController->showLoginForm();
});

$router->addRoute('/login-action', function () use ($loginController) {
    $loginController->handleLogin();
});

$router->addRoute('/logout', function () use ($loginController) {
    $loginController->handleLogout();
});

$router->addRoute('/admin', function () use ($productController) {
    $productController->showAdminDashboard();
});

$router->addRoute('/admin/manage/category', function () use ($categoryController) {
    $categoryController->manageCategories();
});

$router->addRoute('/add-category-action', function () use ($categoryController) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $categoryController->addCategory($_POST['name'], $_POST['parent_id'] ?? null);
    }
});

$router->addRoute('/delete-category/{id}', function ($params) use ($categoryController) {
    $categoryController->deleteCategory($params['id']);
});

$router->addRoute('/admin/manage/product/add', function () use ($productController) {
    $productController->showAddForm();
});

$router->addRoute('/admin/manage/product/edit/{id}', function ($params) use ($productController) {
    $productController->editProduct($params['id'], $_POST);
});

$router->addRoute('/add-product-action', function () use ($productController) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productController->addProduct();
    }
});

$router->addRoute('/edit-product/{id}', function ($params) use ($productController) {
    $productId = $params['id'];
    $productController->editProduct($productId, $_POST);
});

$router->addRoute('/delete-product/{id}', function ($params) use ($productController) {
    $productId = $params['id'];
    $productController->deleteProduct($productId);
});

$router->dispatch();
?>