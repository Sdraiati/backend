<?php

// Definisci le directory di origine e destinazione
// project_cake
// project_home
// project_shared
// {{ ProjectInfo Name }}

// accout_home
// {{ Account Name }}

// Leggi tutti i file nella cartella "content"
//  $contentFiles = scandir($contentDir);

function get_html($path) {
	// Leggi il contenuto del file HTML
	$contentDir = '../../scripts/content/';
	$layoutDir = '../../scripts/layout/';
	$array = [
    	["path" => "index", "title" => "Home"],
    	["path" => "account_home", "title" => "Account Home"],
    	["path" => "project_home", "title" => "ProjectInfo Home"],
		["path" => "project_cake", "title" => "ProjectInfo Cake"],
    	["path" => "project_shared", "title" => "Shared ProjectInfo"],
    	["path" => "tag_page", "title" => "Tag Page"]
	];

	$content = file_get_contents($contentDir . $path . ".html");
	// Cerca e sostituisci le righe di import
	// function($matches) => callback che definisce come rimpiazzare un match.
	$content = preg_replace_callback('/^\s*import\s+(.+)$/m', function($matches) use ($layoutDir) {
		$layoutFile = trim($matches[1]); 
		$layoutContent = file_get_contents($layoutDir . $layoutFile);
		return $layoutContent;
	}, $content);

	$title = "";
	foreach ($array as $row) {
		if ($row["path"] == $path) {
			$title = $row;
			break;
		}
	}

	$content = str_replace("{{ Title }}", $title["title"], $content);
	return $content;
}


?>

