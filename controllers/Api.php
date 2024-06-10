<?php

$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$user = new UserInfo($database);

abstract class Api
{
	protected $path;
	protected $method;
	protected $inputParams;

	protected function __construct($path, $method, $inputParams)
	{
		$this->path = $path;
		$this->method = $method;
		$this->inputParams = $inputParams;
	}

	private function post($param)
	{
		$json = file_get_contents("php://input");

		$data = json_decode($json, true);
		if ($data !== null && isset($data[$param])) {
			return $data[$param];
		} else if (isset($_POST[$param])) {
			return $_POST[$param];
		} else {
			return null;
		}
	}

	private function get($param)
	{
		$json = file_get_contents("php://get");

		$data = json_decode($json, true);
		if ($data !== null && isset($data[$param])) {
			return $data[$param];
		} else if (isset($_GET[$param])) {
			return $_GET[$param];
		} else {
			return null;
		}
	}

	private function is_input_valid($input)
	{
		foreach ($input as $param) {
			if ($param === null) {
				return false;
			}
		}
		return true;
	}

	protected function error($message)
	{
		header('Content-Type: application/json');
		echo json_encode(['error' => $message]);
	}

	protected function getInputParams()
	{
		$params = [];
		if ($this->method === 'GET') {
			foreach ($this->inputParams as $param) {
				$params[] = $this->get($param) ?? null;
			}
		} else if ($this->method === 'POST') {
			foreach ($this->inputParams as $param) {
				$params[] = $this->post($param) ?? null;
			}
		}

		if (!$this->is_input_valid($params)) {
			return null;
		}

		return $params;
	}

	protected function isLogged(): bool
	{
		global $user;
		if (isset($_COOKIE['login'])) {
			$data = json_decode($_COOKIE['login'], true);
			$logged = $user->existsByEmail($data['email']);
			if ($logged) {
				return true;
			}
		}
		return false;
	}

	protected function getUser(): array
	{
		global $user;
		$data = json_decode($_COOKIE['login'], true);
		return $user->getUser($data['email']);
	}

	public function match($path, $method): bool
	{
		return "/" . $this->path === $path && $this->method === $method;
	}

	abstract public function handle();
}
