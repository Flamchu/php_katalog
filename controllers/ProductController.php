<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    private $categoryModel;
    private $productModel;

    public function __construct($pdo)
    {
        $this->categoryModel = new Category($pdo);
        $this->productModel = new Product($pdo);
    }

    public function showAddForm()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /katalog/login');
            exit;
        }

        $categories = $this->categoryModel->getAllCategories();
        require __DIR__ . '/../views/add_product.php';
    }

    public function showAdminDashboard()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /katalog/login');
            exit;
        }

        $products = $this->productModel->getAllProducts();
        require __DIR__ . '/../views/admin.php';
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $short_description = $_POST['short_description'] ?? '';
            $detailed_description = $_POST['detailed_description'] ?? '';
            $specifications = $_POST['specifications'] ?? '';
            $features = $_POST['features'] ?? '';
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category_id'] ?? null;

            $productId = $this->productModel->addProduct(
                $name,
                $short_description,
                $detailed_description,
                $specifications,
                $features,
                $price
            );

            if ($productId && $category_id) {
                $this->productModel->linkProductToCategory($productId, $category_id);
                header('Location: /katalog/admin');
                exit;
            } else {
                // Handle error - maybe show the form again with error message
                $categories = $this->categoryModel->getAllCategories();
                $error = "Failed to add product";
                require __DIR__ . '/../views/add_product.php';
            }
        }
    }

    public function editProduct($id, $data = [])
    {
        if (empty($data)) {
            $product = $this->productModel->getProductById($id);
            $categories = $this->categoryModel->getAllCategories();

            if (!$product) {
                header("HTTP/1.0 404 Not Found");
                echo "Product not found";
                return;
            }

            require __DIR__ . '/../views/edit_product.php';
        } else {
            $this->productModel->editProduct($id, $data);

            if (isset($data['category_id'])) {
                $this->productModel->updateProductCategory($id, $data['category_id']);
            }

            header('Location: /katalog/admin');
            exit;
        }
    }

    public function deleteProduct($id)
    {
        $this->productModel->deleteProduct($id);
        header('Location: /katalog/admin');
        exit;
    }

    public function showProduct($id)
    {
        $product = $this->productModel->getProductById($id);
        $categories = $this->categoryModel->getAllCategories();

        if ($product) {
            require __DIR__ . '/../views/product.php';
        } else {
            header("HTTP/1.0 404 Not Found");
            echo 'Produkt nebyl nalezen.';
        }
    }
}