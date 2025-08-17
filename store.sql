CREATE TABLE products(
    idProd INT NOT NULL AUTO_INCREMENT,user_id INT NOT NULL, codeProd VARCHAR(255) NOT NULL, nomProd TEXT NOT NULL, description TEXT NOT NULL, image TEXT, weight FLOAT NOT NULL, costPrice INT NOT NULL, salePrice INT NOT NULL, created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    ,modified_at TIMESTAMP ,PRIMARY KEY(idProd)
);
CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT, firstName VARCHAR(255) NOT NULL,lastName VARCHAR(255), email VARCHAR(255),password VARCHAR(255) NOT NULL, telephone VARCHAR(100) NOT NULL, idRole INT NOT NULL, created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    ,modified_at TIMESTAMP, PRIMARY KEY(id)
);

ALTER TABLE products ADD CONSTRAINT fk_products_users FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255),
    login VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    id_role INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NULL,
    PRIMARY KEY (id)
);

CREATE TABLE products (
    id_prod INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    code_prod VARCHAR(255) NOT NULL,
    name_prod TEXT NOT NULL,
    description TEXT NOT NULL,
    image TEXT,
    weight DECIMAL(10,2) NOT NULL,
    cost_price DECIMAL(10,2) NOT NULL,
    sale_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NULL,
    PRIMARY KEY (id_prod),
    CONSTRAINT fk_products_users FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

"../assets/images/1.jpg","../assets/images/2.jpg","../assets/images/3.jpg","../assets/images/4.jpg","../assets/images/5.jpg","../assets/images/6.jpg","../assets/images/7.jpg","../assets/images/8.jpg","../assets/images/9.jpg","../assets/images/10.jpg","../assets/images/11.jpg","../assets/images/12.jpg","../assets/images/13.jpg","../assets/images/14.jpg","../assets/images/15.jpg","../assets/images/16.jpg"

/* todo */
verify why the auto porpulating of the db doesnot produce the right amt of data for the given data(for ex if num = 5 it may produce 3)


<?php
// require_once "../classes/Product.class.php";
require_once "../includes/autoloader.inc.php";

$product = new Product();

$draw = $_POST['draw'];
$start = $_POST['start'];
$length = $_POST['length'];
$search = $_POST['search']['value'] ?? '';

// Count total records
$total = $product->countProducts();

// Get filtered records
$data = $product->getProductsServerSide($start, $length, $search);
$recordsFiltered = $product->countFilteredProducts($search);

// Prepare JSON response
$response = [
    "draw" => intval($draw),
    "recordsTotal" => intval($total),
    "recordsFiltered" => intval($recordsFiltered),
    "data" => $data
];

// Fill `data` array with the rows\

echo json_encode($response);
