<?php

include_once 'HtmlApi.php';
include_once __PROJECTROOT__ . '/models/database/project/ProjectInfo.php';


global $database;
$projectManager = new ProjectInfo($database);


class AccountHomeHtmlApi extends HtmlApi
{
	public function __contruct($path)
	{
		parent::__construct($path);
	}

	private function get_project_list()
	{
		global $projectManager;
		$user = $this->getUser();
		$projects = $projectManager->getProjectList($user['email']);
		if (count($projects) === 1 && $projects[0] === null) {
			return '<p>Non hai nessun progetto</p>';
		}
		$project_list = '';
		foreach ($projects as $project) {
			$project_layout = $this->getContent('project_item');
			$project_layout = str_replace('{{ project-name }}', $project['nome'], $project_layout);
			$project_layout = str_replace('{{ project-description }}', $project['descrizione'], $project_layout);
			$project_layout = str_replace('{{ project-id }}', $project['id'], $project_layout);
			$project_layout = str_replace('{{ project-link }}', $project['link_condivisione'], $project_layout);
			$project_list .= $project_layout;
		}
		return $project_list;
	}

	public function handle()
	{
		if (!$this->isLogged()) {
			$content = $this->getContent('resource_not_found');
			$content = str_replace('{{ header }}', $this->getHeader(), $content);
			echo $content;
			return;
		}
		$content = $this->getContent($this->path);
		$content = str_replace('{{ header }}', $this->getHeader(), $content);

		$user = $this->getUser();
		$content = str_replace('{{ username }}', $user['username'], $content);
		$content = str_replace('{{ email }}', $user['email'], $content);

		$content = str_replace('{{ projects }}', $this->get_project_list(), $content);
		echo $content;
	}
}
