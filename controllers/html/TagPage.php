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
		$tags = $tagManager->getTagList($project_id);
		if (count($tags) === 0) {
			return 'NON vi sono <span lang="en">tag</span> associati a questo progetto';
		} else {
			// html generato
			$tag_list = '';

			foreach ($tags as $tag) {
				if ($tag) {
					$tag_item = $this->getContent('tag_item');
					$tag_item = str_replace('{{ tag-name }}', $tag["nome"], $tag_item);
					$tag_item = str_replace('{{ tag-desc }}', $tag["descrizione"], $tag_item);
					$tag_item = str_replace('{{ tag-id }}', $tag["id"], $tag_item);
					$tag_list .= $tag_item;
				}
			}
		}
		return $tag_list;
	}

	public function handle()
	{
		$content = $this->getContent($this->path);
		if (!$content) {
			$content = $this->getContent('resource_not_found');
		}
		$content = str_replace('{{ header }}', $this->getHeader(), $content);
		$content = str_replace('{{ tag-list }}', $this->get_tag_list(), $content);
		$content = str_replace('{{ proj-id }}', $_GET['project_id'], $content);
		echo $content;
	}
}