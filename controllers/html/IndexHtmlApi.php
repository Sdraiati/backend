<?php

class IndexHtmlApi extends HtmlApi
{
	public function __construct($path)
	{
		parent::__construct($path);
	}

	public function handle()
	{
		$content = $this->getContent('index');
		$content = str_replace('{{ header }}', $this->getHeader(), $content);
		echo $content;
	}
}
