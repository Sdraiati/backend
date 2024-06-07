<?php

include_once 'HtmlApi.php';

class SpecialHtmlApi extends HtmlApi
{
	private $LoginFn;

	public function __construct($path, $logicFn, $inputParams)
	{
		parent::__construct($path, 'GET', $inputParams);
		$this->LoginFn = $logicFn;
	}

	public function handle()
	{
		$content = $this->getContent($this->path);
		$params = $this->getInputParams();

		if (!$content || !$params) {
			$content = $this->getContent('resource_not_found');
			echo str_replace('{{ header }}', $this->getHeader(), $content);
			return;
		}

		$content = str_replace('{{ header }}', $this->getHeader(), $content);
		$params[] = $content;
		$content = call_user_func($this->LoginFn, $params);
		return $content;
	}
}

class SpecialHtmlApiBuilder
{
	private $path;
	private $logicFn;
	private $inputParams;

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

	public function build()
	{
		if (!$this->logicFn || !$this->path || !$this->inputParams) {
			throw new Exception('Logic function is required');
		}
		return new SpecialHtmlApi($this->path, $this->logicFn, $this->inputParams);
	}
}
