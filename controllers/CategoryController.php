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

    public function addCategory($name)
    {
        if ($name) {
            $this->categoryModel->addCategory($name);
        }
        header('Location: ../controllers/CategoryController.php?action=manage');
    }

    public function deleteCategory($id)
    {
        $this->categoryModel->deleteCategory($id);
        header('Location: ../controllers/CategoryController.php?action=manage');
    }
}

if (isset($_GET['action'])) {
    $categoryController = new CategoryController($pdo);

    if ($_GET['action'] === 'manage') {
        $categoryController->manageCategories();
    } elseif ($_GET['action'] === 'add' && isset($_GET['name'])) {
        $name = $_GET['name'];
        $categoryController->addCategory($name);
    } elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $categoryController->deleteCategory($id);
    } else {
        $categoryController->manageCategories();
    }
}
?>