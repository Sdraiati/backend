<?php

/*
require_once("routes.php");
require_once("models/database/user/UserInfo.php");


session_start();

$logged = isset($_COOKIE["LogIn"]);
if ($logged) {
	$_SESSION["LogIn"] = $_COOKIE["LogIn"];
}

$url = formatUrl($_SERVER['REQUEST_URI']);


if (array_key_exists($url, $routes)) {
	if(isset($_COOKIE["LogIn"]))
	{
		$data = json_decode($_COOKIE["LogIn"], true);
		$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
		$user = new UserInfo($database);
		$logged = $user->existsByEmail($data['email']);
		if ($logged) {
			$_SESSION["LogIn"] = $_COOKIE["LogIn"];
		}
	}
	else{
		$logged = false;
	}
	$fun = $routes[$url];
	try {	
		$fun($_SERVER['REQUEST_METHOD'], $logged);
	} catch (Exception $e) {
		print $e->getMessage();
	}
} else {
	$controller->renderPage("resource_not_found", $logged);
}
*/

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

//$url = formatUrl($_SERVER['REQUEST_URI']);

$router = new Router();

$router->addRoute($project_router);
$router->addRoute($user_router);
$router->addRoute($html_router);
$router->addRoute($mov_router);
$router->addRoute($tag_router);

$router->handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
