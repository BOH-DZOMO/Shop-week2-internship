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
    public function getProducts(){
        $query = "SELECT * FROM products";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt = null;
    }
}
