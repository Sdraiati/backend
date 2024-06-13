<?php

include_once __PROJECTROOT__ . '/controllers/Api.php';
include_once __PROJECTROOT__ . '/api/config/db_config.php';
include_once __PROJECTROOT__ . '/api/config/database.php';

class HtmlApi extends Api
{
	public function __construct($path)
	{
		parent::__construct($path, 'GET', []);
	}

	public function match($path, $method): bool
	{
		$path = explode('?', $path)[0];
		return "/" . $this->path === $path && $this->method === $method;
	}

	protected function getContent($path)
	{
		$filename = __PROJECTROOT__ . '/views/' . $path . '.html';
		if (file_exists($filename)) {
			return file_get_contents($filename);
		}
		return null;
	}

	protected function getHeader()
	{
		if ($this->isLogged()) {
			return $this->getContent('header_logged');
		}
		return $this->getContent('header');
	}

	public function handle()
	{
		$content = $this->getContent($this->path);
		if (!$content) {
			$content = $this->getContent('resource_not_found');
		}
		$content = str_replace('{{ header }}', $this->getHeader(), $content);
		echo $content;
	}
}
