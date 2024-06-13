<?php

define('__PROJECTROOT__', dirname(__FILE__, 3));

include_once __PROJECTROOT__ . '/controllers/Api.php';
include_once __PROJECTROOT__ . '/api/config/db_config.php';
include_once __PROJECTROOT__ . '/api/config/database.php';

class JsonApi extends Api
{
	private $logicFn;

	public function __construct($path, $inputParams, $logicFn)
	{
		parent::__construct($path, 'POST', $inputParams);
		$this->logicFn = $logicFn;
	}

	public function handle()
	{
		$params = $this->getInputParams();
		if ($params === null) {
			$this->error("Invalid input");
			return;
		}

		call_user_func($this->logicFn, $params);
	}
}

class JsonApiBuilder
{
	private $path;
	private $inputParams;
	private $logicFn;

	public function setPath($path)
	{
		$this->path = $path;
		return $this;
	}

	public function setLogicFn($logicFn)
	{
		$this->logicFn = $logicFn;
		return $this;
	}

	public function setInputParams($inputParams)
	{
		$this->inputParams = $inputParams;
		return $this;
	}

	public function createApi(): JsonApi
	{
		if (empty($this->path) || empty($this->inputParams) || empty($this->logicFn)) {
			throw new Exception("All necessary parameters must be set before creating the API");
		}

		return new JsonApi($this->path, $this->inputParams, $this->logicFn);
	}
}
