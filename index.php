<?php

require_once("routes.php");

function formatUrl($stringa) {
    $posizionePunto = strpos($stringa, '.');
    
    if ($posizionePunto !== false) {
        return substr($stringa, 0, $posizionePunto);
    } else {
        return $stringa;
    }
}

session_start();

$logged = isset($_COOKIE["logIn"]);
if($logged) {$_SESSION["LogIn"] = $_COOKIE["LogIn"];}
$url = formatUrl($_SERVER['REQUEST_URI']);


if(array_key_exists($url, $routes))
{
    $logged = isset($_COOKIE["logIn"]);
    if($logged) {$_SESSION["LogIn"] = $_COOKIE["LogIn"];}
    $fun = $routes[$url];
    $fun($_SERVER['REQUEST_METHOD'], $logged);
}
else{
    $controller->renderPage("resource_not_found", $logged); 
}