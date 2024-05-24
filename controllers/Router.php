<?php

include_once 'Api.php';

class Router
{
	private $routes = [];

	public function __construct()
	{
		$this->routes = [];
	}

	// Add an api to the list of routes (apis)
	public function addRoute($api)
	{
		array_push($this->routes, $api);
	}

	// Find the route that matches the path and method, and call its handle 
	// method to process the request
	public function handle($path, $method)
	{
		foreach ($this->routes as $route) {
			if ($route->match($path, $method)) {
				$route->handle();
				return;
			}
		}
		http_response_code(404);
	}
}
