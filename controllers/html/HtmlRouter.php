<?php

include_once 'HtmlApi.php';
include_once 'AccountHomeHtmlApi.php';
include_once 'ProjectSharedHtmlApi.php';
include_once __PROJECTROOT__ . '/api/config/db_config.php';
include_once __PROJECTROOT__ . '/api/config/database.php';
include_once __PROJECTROOT__ . '/models/database/project/ProjectInfo.php';

$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$project_manager = new ProjectInfo($database);

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

$about_us = new HtmlApi('about_us');
$index = new IndexHtmlApi('');
$index2 = new HtmlApi('index');
$project_cake = new HtmlApi('project_cake');
$project_home = new HtmlApi('project_home');
$release_notes = new HtmlApi('release_notes');
$account_home = new AccountHomeHtmlApi('account_home');
$project_shared = new ProjectSharedHtmlApi('project_shared');

$html_router = new Router();
$html_router->addRoute($about_us);
$html_router->addRoute($index);
$html_router->addRoute($index2);
$html_router->addRoute($project_cake);
$html_router->addRoute($project_home);
$html_router->addRoute($release_notes);
$html_router->addRoute($account_home);
$html_router->addRoute($project_shared);
