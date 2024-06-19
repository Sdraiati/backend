<?php

include_once 'JsonApi.php';

include_once __PROJECTROOT__ . '/controllers/Router.php';
include_once __PROJECTROOT__ . '/models/database/tag/DeleteTag.php';
include_once __PROJECTROOT__ . '/models/database/tag/NewTag.php';
include_once __PROJECTROOT__ . '/models/database/tag/ModifyTag.php';
include_once __PROJECTROOT__ . '/api/config/db_config.php';
include_once 'lib.php';

$deleteTag = (new JsonApiBuilder())
	->setPath('tag/delete')
	->setInputParams(['tag_id', 'project_id'])
	->setLogicFn(
		function ($params) {
			try {
                
				if (!isLogged() || !isUserInProject($params[1])) {
					http_response_code(400);
					echo json_encode(['error' => "user not authorized"]);
				}
                $deleteHandler = new DeleteTag(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				$deleteHandler->deleteTag($params[0], $params[1]);

				http_response_code(200);
				echo json_encode(['message' => "Tag deleted", 'redirect' => 'tag_page?project_id=' . $params[1]]);
			} catch (Exception $_) {
				http_response_code(400);
				echo json_encode(['error' => "Resourse not found"]);
			}
		}
	)
	->createApi();

$newTag = (new JsonApiBuilder())
	->setPath('tag/create')
	->setInputParams(['project_id', 'new_name', 'new_description'])
	->setLogicFn(
		function ($params) {
			try {

        		if (!isLogged() || !isUserInProject($params[0])) {
					http_response_code(400);
					echo json_encode(['error' => "user not authorized"]);
				}        
				// creare un record all'interno della tabella dei tag.
                $createHandler = new NewTag(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				$createHandler->createTag($params[0], $params[1], $params[2]);

				http_response_code(200);
				echo json_encode(['message' => "Tag created", 'redirect' => 'tag_page?project_id=' . $params[0]]);
			} catch (Exception $_) {
				http_response_code(400);
				echo json_encode(['error' => "Tag not created"]);
			}
		}
	)
	->createApi();

// ancora da implementare 
$modifyTag = (new JsonApiBuilder())
	->setPath('tag/modify')
	->setInputParams(['project_id', 'tag_id', 'new_name', 'new_description'])
	->setLogicFn(
		function ($params) {
			try {
                if (!isLogged() && !isUserInProject($params[0])) {
					http_response_code(400);
					echo json_encode(['error' => "user not authorized"]);
				}  
                $modifyHandler = new ModifyTag(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				$modifyHandler->modifyTag($params[1], $params[2], $params[3]);

				http_response_code(200);
				echo json_encode(['message' => "Tag modified", 'redirect' => 'tag_page?project_id=' . $params[0]]);
			} catch (Exception $_) {
				http_response_code(400);
				echo json_encode(['error' => "Tag not modified: resource not found"]);
			}
		}
	)
	->createApi();

$tag_router = new Router();
$tag_router->addRoute($deleteTag);
$tag_router->addRoute($newTag);
$tag_router->addRoute($modifyTag);