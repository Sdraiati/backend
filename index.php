<?php

require_once("controllers/json/User.php");
require_once("controllers/json/Project.php");
require_once("controllers/json/Movimento.php");
require_once("controllers/html/HtmlRouter.php");
require_once("controllers/Router.php");
require_once("controllers/json/Tag.php");


session_start();

$logged = isset($_COOKIE["LogIn"]);
if ($logged) {
	$_SESSION["LogIn"] = $_COOKIE["LogIn"];
}

$router = new Router();

$router->addRoute($project_router);
$router->addRoute($user_router);
$router->addRoute($html_router);
$router->addRoute($mov_router);
$router->addRoute($tag_router);

$router->handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
