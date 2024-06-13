<?php

include_once 'HtmlApi.php';
include_once __PROJECTROOT__ . '/models/database/project/ProjectInfo.php';
include_once __PROJECTROOT__ . '/models/database/project/JoinProject.php';


global $database;
$projectManager = new ProjectInfo($database);
$projectJoin = new JoinProject($database);


class ProjectSharedHtmlApi extends HtmlApi
{
	public function __contruct($path)
	{
		parent::__construct($path);
	}

	public function handle()
	{
		global $projectManager;
        $link = '';
		if(isset($_GET['link']))
            $link = $_GET['link'];
        else {
            $content = $this->getContent('resource_not_found');
            $content = str_replace('{{ header }}', $this->getHeader(), $content);
            echo $content;
            return;
        }
		$project = $projectManager->getProjectInfoByLink($link);

		$content = $this->getContent($this->path);
		$content = str_replace('{{ header }}', $this->getHeader(), $content);
		$content = str_replace('{{ Project Name }}', $project['nome'], $content);
		echo $content;
	}
}
