<?php
require_once '../db.php';
require_once '../models/Category.php';
require_once '../models/Product.php';

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
        $categories = $this->categoryModel->getAllCategories();
        require '../views/add_product.php';
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $short_description = $_POST['short_description'];
            $detailed_description = $_POST['detailed_description'];
            $specifications = $_POST['specifications'];
            $features = $_POST['features'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];

            $productId = $this->productModel->addProduct($name, $short_description, $detailed_description, $specifications, $features, $price);

            if ($productId) {
                $this->productModel->linkProductToCategory($productId, $category_id);
                header('Location: ../views/admin.php');
            } else {
                echo "Failed to add product.";
            }
        }
    }

    public function editProduct($id, $data)
    {
        $this->productModel->editProduct($id, $data);
        header('Location: ../views/admin.php');
    }

    public function deleteProduct($id)
    {
        $this->productModel->deleteProduct($id);
        header('Location: ../views/admin.php');

    }

    public function getProductById($id)
    {
        global $pdo;
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include '../views/product.php';
        } else {
            echo 'Produkt nebyl nalezen.';
        }
    }
}

$productController = new ProductController($pdo);

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'showAddForm') {
        $productController->showAddForm();
    } elseif ($_GET['action'] === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $productController->addProduct();
    } elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        $productController->deleteProduct($_GET['id']);
    } elseif ($_GET['action'] === 'edit' && isset($_GET['id'])) {
        $productController->editProduct($_GET['id'], $_POST);
    } elseif ($_GET['action'] === 'view' && isset($_GET['id'])) {
        $productController->getProductById($_GET['id']);
    }
}
?>