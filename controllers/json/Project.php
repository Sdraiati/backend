<?php

include_once 'JsonApi.php';
include_once __PROJECTROOT__ . '/controllers/Router.php';
include_once __PROJECTROOT__ . '/api/config/db_config.php';
require_once __PROJECTROOT__ . '/models/database/project/NewProject.php';
require_once __PROJECTROOT__ . '/models/database/project/ProjectInfo.php';
require_once __PROJECTROOT__ . '/models/database/project/JoinProject.php';
require_once __PROJECTROOT__ . '/models/database/project/DeleteProject.php';
require_once __PROJECTROOT__ . '/models/database/project/DisjoinProject.php';

$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$projectManager = new ProjectInfo($database);
$joinProget = new JoinProject($database);
$projectDel = new DeleteProject($database);
$projectDJ = new DisjoinProject($database);
$projectNew = new NewProject($database);

function randomString($lunghezza = 10, $caratteri = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
	$stringaCasuale = '';
	$numeroCaratteri = strlen($caratteri);

	for ($i = 0; $i < $lunghezza; $i++) {
		$stringaCasuale .= $caratteri[rand(0, $numeroCaratteri - 1)];
	}

	return $stringaCasuale;
}

$deleteProject = (new JsonApiBuilder())
	->setPath('project/delete')
	->setInputParams(['link'])
	->setLogicFn(
		function ($params) {
			global $projectManager;
			global $projectDel;
			try {
				$id_project = $projectManager->getIDProjectByLink($params[0]);
				$projectDel->deleteProject($id_project);

				http_response_code(200);
				echo json_encode(['message' => 'Project deleted']);
			} catch (Exception $e) {
				http_response_code(400);
				echo json_encode(['error' => $e->getMessage()]);
			}
		}
	)
	->createApi();

$disjoinProject = (new JsonApiBuilder())
	->setPath('project/disjoin')
	->setInputParams(['link'])
	->setLogicFn(
		function ($params) {
			global $projectManager;
			global $projectDJ;
			try {
				$id_project = $projectManager->getIDProjectByLink($params[0]);
				$email = json_decode($_SESSION["LogIn"], true)["email"];
				$projectDJ->disjoinProject($email, $id_project);

				http_response_code(200);
				echo json_encode(['message' => 'Project disjoined']);
			} catch (Exception $e) {
				http_response_code(400);
				echo json_encode(['error' => "You are the only one in the project"]);
			}
		}
	)
	->createApi();

$newProject = (new JsonApiBuilder())
	->setPath('project/new')
	->setInputParams(['nomeProgetto', 'descrizioneProgetto'])
	->setLogicFn(
		function ($params) {
			global $projectNew;
			try {
				$email = json_decode($_SESSION["LogIn"], true)["email"];
				$link_condivisione = randomString();
				$projectNew->createProject($email, $params[0], $link_condivisione, $params[1]);

				http_response_code(201);
				echo json_encode(['message' => 'Project created']);
			} catch (Exception $e) {
				http_response_code(400);
				echo json_encode(['error' => $e->getMessage()]);
			}
		}
	)
	->createApi();

$joinProject = (new JsonApiBuilder())
	->setPath('project/join')
	->setInputParams(['link'])
	->setLogicFn(
		function ($params) {
			global $projectManager;
			global $joinProget;
			try {
				$id_project = $projectManager->getIDProjectByLink($params[0]);
				$email = json_decode($_SESSION["LogIn"], true)["email"];
				$joinProget->joinProject($email, $id_project);

				http_response_code(201);
				echo json_encode(['message' => 'Project joined']);
			} catch (Exception $e) {
				http_response_code(400);
				echo json_encode(['error' => $e->getMessage()]);
			}
		}
	)
	->createApi();

$project_router = new Router();
$project_router->addRoute($deleteProject);
$project_router->addRoute($disjoinProject);
$project_router->addRoute($newProject);
$project_router->addRoute($joinProject);
