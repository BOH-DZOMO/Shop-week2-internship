<?php
require_once "config.session.inc.php";
include_once "autoloader.inc.php";



// if (isset($_POST[""])) {



//     if (allFieldsFilled([])) {
     
//     } else {
//         header('location:../pages/create_task.php?error=create_task');
//         die();
//     }
// } elseif (isset($_POST[""])) {
   

//     if (allFieldsFilled([])) {
//     } else {
//         header('location:../pages/edit-task.php?error=update_task');
//         die();
//     }  
// }
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
