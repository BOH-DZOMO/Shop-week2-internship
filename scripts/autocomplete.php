<?php

    require_once "../includes/autoloader.inc.php";
    
    if(isset($_GET["term"]) && isset($_GET["q"])){
        $term = $_GET["term"];
        $product = new Product();
        $result = $product->getProductName($term);
        $response = [
            "results" => [],
            "pagination" => ["more" => false]
        ];
        
        // $id = 1;
        foreach ($result as $key => $value) {
            $response["results"][] = [

                "id" => $key,
                "text" => $value
            ];
        };

        echo json_encode($response);
        
    }
    elseif (isset($_GET["term"])) {
        $data = $_GET["term"];
        $product = new Product();
        $result = $product->getProductName($data);
        echo json_encode($result);
    }


