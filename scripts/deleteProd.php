<?php
require_once "../includes/autoloader.inc.php";
if (isset($_POST["id"])) {
    $post_id = $_POST["id"];
    $product = new Product();
    $data = null;
    if ($product->deleteProd($post_id)) {
        $data = "success";
    }
    else {
        $data = "failure";
    }


    echo json_encode(["status"=>$data]);
}