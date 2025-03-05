<?php
class Category
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllCategories()
    {
        return $this->pdo->query("SELECT * FROM categories")->fetchAll();
    }

    public function addCategory($name, $parentId)
    {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name, parent_id) VALUES (:name, :parent_id)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':parent_id', $parentId, $parentId !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->execute();
    }

    public function getSubcategories($parentId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE parent_id = :parent_id");
        $stmt->execute(['parent_id' => $parentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function deleteCategory($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }


}
?>