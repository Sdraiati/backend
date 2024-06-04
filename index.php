<?php

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
		$logged = $user->exists($data['email']);
	}
	else{
		$logged = false;
	}
	if ($logged) {
		$_SESSION["LogIn"] = $_COOKIE["LogIn"];
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

/*
require_once("controllers/json/User.php");
require_once("controllers/Router.php");



session_start();

$logged = isset($_COOKIE["LogIn"]);
if ($logged) {
	$_SESSION["LogIn"] = $_COOKIE["LogIn"];
}

//$url = formatUrl($_SERVER['REQUEST_URI']);

$router = new Router();

$router->addRoute($registerUser);

$router->handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);*/

