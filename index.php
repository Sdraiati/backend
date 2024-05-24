<?php

require_once("routes.php");



session_start();

$logged = isset($_COOKIE["LogIn"]);
if ($logged) {
	$_SESSION["LogIn"] = $_COOKIE["LogIn"];
}
$url = formatUrl($_SERVER['REQUEST_URI']);


if (array_key_exists($url, $routes)) {
	$logged = isset($_COOKIE["LogIn"]);
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

$router->handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
*/
