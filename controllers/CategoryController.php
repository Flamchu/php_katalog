<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../db.php';

class CategoryController
{
    private $categoryModel;
    private $productModel;

    public function __construct($pdo)
    {
        $this->categoryModel = new Category($pdo);
        $this->productModel = new Product($pdo);
    }

    public function manageCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        require __DIR__ . '/../views/manage_categories.php';
    }

    public function addCategory($name, $parentId = null)
    {
        if ($name) {
            $this->categoryModel->addCategory($name, $parentId);
        }
        header('Location: /katalog/admin/manage/category');
    }

    public function showCategory($categoryId)
    {
        $categoryModel = $this->categoryModel;
        $productModel = $this->productModel;

        $categories = $categoryModel->getAllCategories();
        $sort = $_GET['sort'] ?? 'name';

        $products = $categoryId ? $productModel->getProductsByCategory($categoryId, $sort) : [];
        $subcategories = $categoryId ? $categoryModel->getSubcategories($categoryId) : [];

        require __DIR__ . '/../views/category.php';
    }

    public function deleteCategory($id)
    {
        $subcategories = $this->categoryModel->getSubcategories($id);

        if (count($subcategories) > 0) {
            foreach ($subcategories as $subcategory) {
                $this->categoryModel->deleteCategory($subcategory['id']);
            }
        }

        $this->categoryModel->deleteCategory($id);
        header('Location: /katalog/admin/manage/category');
        exit;
    }
}