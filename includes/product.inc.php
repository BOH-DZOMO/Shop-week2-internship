<?php
require_once "config.session.inc.php";
include_once "autoloader.inc.php";



// if (isset($_POST["auto-user"])) {
// $number = $_POST["number"];


//     if (allFieldsFilled([$number])) {
//         $user = new SignUpContr();
//         $user->factoryCreate((int)escape($number));

//     } else {
//         header('location:../pages/first-day-x.php?error=1');
//         die();
//     }
if (isset($_POST["auto-product"])) {
    $number = $_POST["number"];

    if (allFieldsFilled([$number])) {
        $product = new ProductContr();
        $product->factoryCreate((int)escape($number));
        header('location:../pages/first-day-x.php');
    } else {
        header('location:../pages/first-day-x.php?error=2');
        die();
    }
} 
elseif (isset($_POST["create_product"])) {
    $code       = $_POST['code_prod'];
    $name       = $_POST['name_prod'];
    $description = $_POST['description'];
    $weight     = $_POST['weight'];
    $cost_price = $_POST['cost_price'];
    $sale_price = $_POST['sale_price'];
    $errors = [];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $upload_dir = "../assets/images/";

        $image_path = $upload_dir . $image_name;
        echo $image_path;
        if (!move_uploaded_file($image_tmp_name, $image_path)) {
            // header('location:../pages/create.php?error=image');
            $errors["image"] = "image was not uploaded succesfully";
        }

        if (allFieldsFilled([$code, $name, $description, $_FILES["image"], $weight, $cost_price, $sale_price])) {
           if (empty($errors)) {
             $product = new ProductContr;
            $product->create($_SESSION["user_id"], escape($code), escape($name), escape($description), $image_path, floatval(escape($weight)), escape($cost_price), escape($sale_price));
           }

        } 
        else {
            $errors["fields"] = "Fill all Fields";
            $_SESSION["errors_product"] = $errors;
            header('location:../pages/create.php?error=unfilled');
            die();
        }
    }
}
else {
        header('location:../pages/create.php');
        die();
    }

// else {
//     header('location:../index.php?source=task.inc');
//     die();
// }

function allFieldsFilled(array $data): bool
{
    foreach ($data as $key => $value) {
        if (empty($value) && $value !== '0' && $value !== 0) {
            return false;
        }
    }
    return true;
}
function escape($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
