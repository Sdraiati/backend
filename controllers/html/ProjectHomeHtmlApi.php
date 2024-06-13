<?php

include_once 'HtmlApi.php';
include_once __PROJECTROOT__ . '/models/database/project/ProjectInfo.php';

global $database;
$projectManager = new ProjectInfo($database);

class ProjectHomeHtmlApi extends HtmlApi
{
	public function __contruct($path)
	{
		parent::__construct($path);
	}

	private function get_project_name($project_id)
	{
		global $projectManager;
		if (!$projectManager->exists($project_id)) {
			return null;
		}
		$project = $projectManager->getProjectInfo($project_id);
		return $project['nome'];
	}

	private function user_has_access_to_project($project_id)
	{
		global $projectManager;
		$user = $this->getUser();
		$project = $projectManager->getProjectList($user['email']);
		foreach ($project as $p) {
			if ($p['id'] == $project_id) {
				return true;
			}
		}
		return false;
	}

	private function access_guard(): bool
	{
		return (!$this->isLogged() || !isset($_GET['project_id']) || !$this->user_has_access_to_project($_GET['project_id']));
	}

	public function handle()
	{
		if ($this->access_guard()) {
			$content = $this->getContent('resource_not_found');
			$content = str_replace('{{ header }}', $this->getHeader(), $content);
			echo $content;
			return;
		}
		$project_id = $_GET['project_id'];

		$content = $this->getContent($this->path);
		$content = str_replace('{{ header }}', $this->getHeader(), $content);
		$content = str_replace('{{ Project Name }}', $this->get_project_name($project_id), $content);
		echo $content;
	}
}
