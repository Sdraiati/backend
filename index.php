<?php

include "controllers/Controller.php";
include "scripts/generate_header.php";

$coso = new Controller();

#print $_SERVER['REQUEST_URI'];

if($_SERVER['REQUEST_METHOD'] == "GET" && $_SERVER['REQUEST_URI'] == "/index.php")
{
    $html_content = file_get_contents('views/index.html');
    $header = generate_header("index");
    $html_content = $header . $html_content;
    $coso->renderPage($html_content);
}
else if($_SERVER['REQUEST_METHOD'] == "GET" && $_SERVER['REQUEST_URI'] == "/about_us")
{
    print $_SERVER['REQUEST_URI'];
    $coso->renderAboutUsPage();
}
else{
    print $_SERVER['REQUEST_URI'];
}