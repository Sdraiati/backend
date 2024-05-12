<?php

include "controllers/Controller.php";

$controller = new Controller();

if($_SERVER['REQUEST_METHOD'] == "GET" && $_SERVER['REQUEST_URI'] == "/backend/index.php")
{
    $controller->renderPage("index", "IL TITOLO");
}
else if($_SERVER['REQUEST_METHOD'] == "GET" && $_SERVER['REQUEST_URI'] == "/backend/about_us")
{
    $controller->renderPage("about_us", "Penny Wise");
}
else{
    //scommentare la riga sotto quando sarà disponibile il file error.html
    //$controller->renderPage("error");
    print $_SERVER['REQUEST_URI'];
    //error 404
}