<?php

declare(strict_types=1);
class Product extends Dbh
{
    public function addProduct(int $user_id, string $code_prod, string $name_prod, string $description, string $image, float $weight, int $cost_price, int $sale_price)
    {
        try {
            $query = "INSERT INTO products (
                    user_id, code_prod, name_prod, description, image, 
                    weight, cost_price, sale_price
                ) VALUES (
                    :user_id, :code_prod, :num_prod, :description, :image, 
                    :weight, :cost_price, :sale_price
                )";

            $stmt = $this->connect()->prepare($query);


            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':code_prod', $code_prod);
            $stmt->bindValue(':num_prod', $name_prod);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':image', $image);
            $stmt->bindValue(':weight', $weight);
            $stmt->bindValue(':cost_price', $cost_price);
            $stmt->bindValue(':sale_price', $sale_price);


            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database insert error: " . $e->getMessage());
            return false;
        }
    }
    public function getProducts()
    { 
        $query = "SELECT * FROM products WHERE `delete_status` = 0 LIMIT 1000";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
    public function countProducts()
    {
        $query = "SELECT COUNT(*) AS total FROM `products`";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['total'];
        $stmt = null;
    }
    public function getProductsServerSide($start, $length, $search)
    {
        $query = "SELECT * FROM products";

        if (!empty($search)) {
            $query .= " WHERE code_prod LIKE :search 
                  OR name_prod LIKE :search 
                  OR description LIKE :search";
        }

        $query .= " ORDER BY created_at DESC LIMIT " . (int)$start . ", " . (int)$length;

        $stmt = $this->connect()->prepare($query);

        if (!empty($search)) {
            $stmt->bindValue(':search', "%$search%");
        }
        $stmt->execute();
        return $stmt->fetchAll();
        // return $stmt->fetchAll(PDO::FETCH_NUM);
    }

    public function countFilteredProducts($search) {
    $query = "SELECT COUNT(*) as total FROM products";
    
    if (!empty($search)) {
        $query .= " WHERE code_prod LIKE :search 
                  OR name_prod LIKE :search 
                  OR description LIKE :search";
    }

    $stmt = $this->connect()->prepare($query);

    if (!empty($search)) {
        $stmt->bindValue(':search', "%$search%");
    }

    $stmt->execute();
    $row = $stmt->fetch();
    return $row['total'];
}
}
