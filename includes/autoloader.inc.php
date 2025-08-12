<?php
spl_autoload_register('myAutoloader');
function myAutoloader($clasname){
    $url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    if (strpos($url, "classes") !== false) {
        $path = "classes/";
    }
    else {
        $path = "../classes/";
    }
    $extension = ".class.php";
    $filePath = $path.$clasname.$extension;
    if (file_exists($filePath)) {
        require_once $filePath;
    }
}
?>