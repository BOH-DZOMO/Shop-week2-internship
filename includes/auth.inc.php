<?php
require_once "config.session.inc.php";
include_once "autoloader.inc.php";

//signin
if (isset($_POST["signIn"])) {
    //grabbing data
    $email = $_POST["email"];
    $pwd = $_POST["password"];

    if (allFieldsFilled([$email,$pwd])) {
        
        $login = new SignInContr(escape($email), escape($pwd));
        $login->loginUser();   
    }
    else {
        $_SESSION["errors_signin"] = "Fill in all fields!";
        header('location:../pages/first-day-x.php?signup=failed');
        die();
    }

}
elseif (isset($_POST["signUp"])) {

    //grabbing data
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $telephone = $_POST["telephone"];
    $email= $_POST["email"];
    $pwd = $_POST["password"];
    $pwd_confirm = $_POST["password_confirm"];

    if (allFieldsFilled([$firstName, $lastName, $pwd, $pwd_confirm, $email, $telephone])) {
        $signup = new SignUpContr(escape($firstName), escape($lastName), escape($pwd), escape($pwd_confirm), escape($email),escape($telephone));
        $signup->signupUser();
    }
    else {
        $_SESSION["errors_signup"] = "Fill in all fields!";
        header('location:../pages/first-day-x.php?signup=failed');
        die();
    }
}
elseif (isset($_POST["auto-user"])) {
$number = $_POST["number"];


    if (allFieldsFilled([$number])) {
        $user = new SignUpContr();
        $user->factoryCreate((int)escape($number));
     
    } else {
        header('location:../pages/first-day-x.php?error=1');
        die();
    }
}
else {
    header('location:../index.php');
    die();
}


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
