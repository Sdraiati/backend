<?php

include_once 'HtmlApi.php';
include_once __PROJECTROOT__ . '/models/database/tag/TagInfo.php';

global $database;
$tagManager = new TagInfo($database);

class TagPageHtmlApi extends HtmlApi 
{
    public function __contruct($path)
	{
		parent::__construct($path);
	}

	private function get_tag_list()
	{
		global $tagManager;
		$project_id = $_GET['project_id'];
		$tags = $tagManager->getTagsByIdProgetto($project_id);
		if (count($tags) != 0) {
			return '<p> vi sono tag associati a questo progetto</p>';
		}
		$tag_list = '';
		foreach ($tags as $tag) {
			// fare la stessa cosa con i tag.
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
		$content = $this->getContent($this->path);
		if (!$content) {
			$content = $this->getContent('resource_not_found');
		}
		$content = str_replace('{{ header }}', $this->getHeader(), $content);
		echo $content;
	}
}