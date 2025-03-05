<?php
require_once '../models/Category.php';
require_once '../db.php';

class CategoryController
{
    private $categoryModel;

    public function __construct($pdo)
    {
        $this->categoryModel = new Category($pdo);
    }

    public function manageCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        require '../views/manage_categories.php';
    }

    public function addCategory($name, $parentId = null)
    {
        if ($name) {
            $this->categoryModel->addCategory($name, $parentId);
        }
        header('Location: ../controllers/CategoryController.php?action=manage');
        exit;
    }

    public function deleteCategory($id)
    {

        $this->categoryModel->deleteCategory($id);
        $subcategories = $this->categoryModel->getSubcategories($id);

        if (count($subcategories) > 0) {
            foreach ($subcategories as $subcategory) {
                $this->categoryModel->deleteCategory($subcategory['id']);
            }
        }
        header('Location: ../controllers/CategoryController.php?action=manage');
        exit;
    }
}

if (isset($_GET['action'])) {
    $categoryController = new CategoryController($pdo);

    if ($_GET['action'] === 'manage') {
        $categoryController->manageCategories();
    } elseif ($_GET['action'] === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? null;
        $parentId = !empty($_POST['parent_id']) ? $_POST['parent_id'] : null;
        $categoryController->addCategory($name, $parentId);
    } elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $categoryController->deleteCategory($id);
    } else {
        $categoryController->manageCategories();
    }
}
?>