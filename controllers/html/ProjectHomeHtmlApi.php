<?php

include_once 'HtmlApi.php';
include_once __PROJECTROOT__ . '/models/database/project/ProjectInfo.php';
include_once __PROJECTROOT__ . '/models/database/user/UserInfo.php';

global $database;
$projectManager = new ProjectInfo($database);
$userManager = new UserInfo($database);
$tagManager = new TagInfo($database);

class ProjectHomeHtmlApi extends HtmlApi
{
	public function __contruct($path)
	{
		parent::__construct($path);
	}

	private function get_project_name($project_id) : string | null
	{
		global $projectManager;
		if (!$projectManager->exists($project_id)) {
			return null;
		}
		$project = $projectManager->getProjectInfo($project_id);
		return $project['nome'];
	}

    private function get_project_description($project_id) : string | null
    {
        global $projectManager;
        if (!$projectManager->exists($project_id)) {
            return null;
        }
        $project = $projectManager->getProjectInfo($project_id);
        return $project['descrizione'];

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

    private function get_partecipants_list() : string
    {
        global $userManager;
        $project_id = $_GET['project_id'];
        $partecipants = $userManager->getPartecipantsList($project_id);
        if (count($partecipants) === 1 && $partecipants[0] === null) {
            return '<p>Non ci sono partecipanti</p>';
        }
        $partecipants_list = '';
        foreach ($partecipants as $partecipant) {
            $partecipants_list .= '<li>' . $partecipant . '</li>';
        }
        return $partecipants_list;
    }

    private function get_tags_list() : string
    {
        global $tagManager;
        $project_id = $_GET['project_id'];
        $tags = $tagManager->getTagList($project_id);
        if (count($tags) === 1 && $tags[0] === null) {
            return '<p>Non ci sono tag</p>';
        }
        $tags_list = '';
        //inserisce un bottone per ogni tag
        foreach ($tags as $tag) {
            $tags_list .= '<div><input type="button" value="' . $tag['nome'] . '"></div>';
        }
        return $tags_list;
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
        global $projectManager;

		$content = $this->getContent($this->path);
		$content = str_replace('{{ header }}', $this->getHeader(), $content);
		$content = str_replace('{{ project-id }}', $project_id, $content);
		$content = str_replace('{{ Project Name }}', $this->get_project_name($project_id), $content);
        $content = str_replace('{{ Project Description }}', $this->get_project_description($project_id), $content);
        $content = str_replace('{{ project-link }}', $projectManager->getProjectInfo($project_id)['link_condivisione'], $content);
        $content = str_replace('{{ tags }}', $this->get_tags_list(), $content);
        $content = str_replace('{{ partecipants }}', $this->get_partecipants_list(), $content);

        echo $content;
	}
}
