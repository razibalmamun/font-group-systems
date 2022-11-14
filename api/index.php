<?php
include './main.php';

$url = isset($_GET['url']) ? $_GET['url'] : false;
if($url) {
    $url = rtrim($url, '/');
    $url = explode('/', filter_var($url, FILTER_SANITIZE_URL));
} else {
    unset($url);
}

if(isset($url[0])) {
    $controllerName = ucfirst($url[0]);
    $methodName = isset($url[1]) ? $url[1] : 'index';
    $paramName = isset($url[2]) ? $url[2] : false;

    $controllerFile = './app/Controllers/'.$controllerName.".php";
    if(file_exists($controllerFile)) {
        include  $controllerFile;
    } else {
        /**
         * if controller name with controller text in that case adding extra Controller string
         */
        include './app/Controllers/'.$controllerName."Controller.php";
        $controllerName = $controllerName."Controller";
    }

    $conObj = new $controllerName();
    if($paramName) {
        $conObj->$methodName($paramName);
    } else {
        $conObj->$methodName();
    }
} else{
    echo "Hello World!";
}

