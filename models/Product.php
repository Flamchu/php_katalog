<?php
class Product
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllProducts($sort = 'name')
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products ORDER BY " . $this->sanitizeSort($sort));
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProductById($productId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetch();
    }

    public function getProductsByCategory($categoryId, $sort = 'name')
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products p 
                                 JOIN product_categories pc ON p.id = pc.product_id 
                                 WHERE pc.category_id = ? 
                                 ORDER BY " . $this->sanitizeSort($sort));
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll();
    }

    public function addProduct($name, $short_description, $detailed_description, $specifications, $features, $price)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO products (name, short_description, detailed_description, specifications, features, price)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$name, $short_description, $detailed_description, $specifications, $features, $price]);
        return $this->pdo->lastInsertId();
    }

    public function linkProductToCategory($product_id, $category_id)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO product_categories (product_id, category_id)
            VALUES (?, ?)
        ");
        $stmt->execute([$product_id, $category_id]);
    }

    public function editProduct($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE products SET name = ?, short_description = ?, detailed_description = ?, specifications = ?, features = ?, price = ? WHERE id = ?");
        $stmt->execute([
            $data['name'],
            $data['short_description'],
            $data['detailed_description'],
            $data['specifications'],
            $data['features'],
            $data['price'],
            $id
        ]);
    }

    public function deleteProduct($id)
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare("DELETE FROM product_categories WHERE product_id = ?");
            $stmt->execute([$id]);

            $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute([$id]);

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function updateProductCategory($productId, $categoryId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM product_categories WHERE product_id = ?");
        $stmt->execute([$productId]);

        $stmt = $this->pdo->prepare("INSERT INTO product_categories (product_id, category_id) VALUES (?, ?)");
        $stmt->execute([$productId, $categoryId]);
    }

    private function sanitizeSort($sort)
    {
        $allowedSorts = ['name', 'price', 'id'];
        return in_array($sort, $allowedSorts) ? $sort : 'name';
    }
}
?>