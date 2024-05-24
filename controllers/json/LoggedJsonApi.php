<?php

include_once '../Api.php';
include_once '../../api/config/database.php';
include_once '../../api/config/db_config.php';

class LoggedJsonApi extends Api
{
	private $logicClass;
	private $logicMethod;
	private $errorHandler;

	public function __construct($path, $method, $inputParams, $logicClass, $logicMethod, $errorHandler)
	{
		parent::__construct($path, $method, $inputParams);
		$this->logicClass = $logicClass;
		$this->logicMethod = $logicMethod;
		$this->errorHandler = $errorHandler;
	}

	private function response($result)
	{
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function handle()
	{
		if (!isset($_COOKIE['LogIn'])) {
			$this->error("Unauthorized");
		}

		$params[] = $_SESSION['email'];
		$params[] = array_merge($params, $this->getInputParams());

		try {
			$logicInstance = new $this->logicClass(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
			$result = call_user_func_array([$logicInstance, $this->logicMethod], $params);
			$this->response($result);
		} catch (Exception $e) {
			call_user_func($this->errorHandler, $e->getMessage());
		}
	}
}

class LoggedJsonApiBuilder
{
	private $path;
	private $method;
	private $inputParams;
	private $logicClass;
	private $logicMethod;
	private $errorHandler;

	public function setPath($path)
	{
		$this->path = $path;
		return $this;
	}

	public function setMethod($method)
	{
		if (!in_array($method, ['GET', 'POST'])) {
			throw new Exception("Invalid method");
		}
		$this->method = $method;
		return $this;
	}

	public function setInputParams($inputParams)
	{
		$this->inputParams = $inputParams;
		return $this;
	}

	public function setLogicClass($logicClass)
	{
		$this->logicClass = $logicClass;
		return $this;
	}

	public function setLogicMethod($logicMethod)
	{
		$this->logicMethod = $logicMethod;
		return $this;
	}

	public function setErrorHandler($errorHandler)
	{
		$this->errorHandler = $errorHandler;
		return $this;
	}

	public function createApi(): Api
	{
		if (empty($this->path) || empty($this->method) || empty($this->logicClass) || empty($this->logicMethod)) {
			throw new Exception("All necessary parameters must be set before creating the API");
		}

		return new LoggedJsonApi($this->path, $this->method, $this->inputParams, $this->logicClass, $this->logicMethod, $this->errorHandler);
	}
}
