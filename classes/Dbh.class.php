<?php
class Dbh
{
    protected function connect()
    {
        try {
            $dsn = "mysql:host=localhost;dbname=shop";
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


            $tasksTableExists = $pdo->query("SHOW TABLES LIKE 'products'")->rowCount() > 0;
            $userstableExists = $pdo->query("SHOW TABLES LIKE 'users'")->rowCount() > 0;

            if (!$tasksTableExists || !$userstableExists) {
                $query = "
                CREATE TABLE users (
                    id INT NOT NULL AUTO_INCREMENT,
                    first_name VARCHAR(255) NOT NULL,
                    last_name VARCHAR(255),
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    telephone VARCHAR(100) NOT NULL,
                    id_role BOOLEAN NOT NULL DEFAULT FALSE,
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    modified_at TIMESTAMP NULL,
                    PRIMARY KEY (id)
                );

                CREATE TABLE products (
                    id_prod INT NOT NULL AUTO_INCREMENT,
                    user_id INT NOT NULL,
                    code_prod VARCHAR(255) NOT NULL,
                    num_prod TEXT NOT NULL,
                    description TEXT NOT NULL,
                    image TEXT,
                    weight DECIMAL(10,2) NOT NULL,
                    cost_price DECIMAL(10,2) NOT NULL,
                    sale_price DECIMAL(10,2) NOT NULL,
                    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    modified_at TIMESTAMP NULL,
                    delete_status BOOLEAN NOT NULL DEFAULT FALSE,
                    PRIMARY KEY (id_prod),
                    CONSTRAINT fk_products_users FOREIGN KEY (user_id) REFERENCES users (id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE
);";
                $pdo->exec($query);
            }

            return $pdo;
        } catch (PDOException $e) {
            echo $e->getCode() . "<br>";
            echo $e->getMessage() . "<br>";
            die();
        }
    }
}
