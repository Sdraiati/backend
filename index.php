<?php

require_once("routes.php");



session_start();

$logged = isset($_COOKIE["LogIn"]);
if($logged) {$_SESSION["LogIn"] = $_COOKIE["LogIn"];}
$url = formatUrl($_SERVER['REQUEST_URI']);


if(array_key_exists($url, $routes))
{
    $logged = isset($_COOKIE["LogIn"]);
    if($logged) {$_SESSION["LogIn"] = $_COOKIE["LogIn"];}
    $fun = $routes[$url];
    $fun($_SERVER['REQUEST_METHOD'], $logged);
}
else{
    $controller->renderPage("resource_not_found", $logged); 
}