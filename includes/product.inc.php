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
    } 
    else {
        header('location:../pages/first-day-x.php?error=2');
        die();
    }  
}
// elseif (isset($_POST[""])) {
   

//     if (allFieldsFilled([])) {
//     } else {
//         header('location:../pages/edit-task.php?error=update_task');
//         die();
//     }  
// }  

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
