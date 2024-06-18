<?php
include_once __PROJECTROOT__ . '/api/config/db_config.php';
include_once __PROJECTROOT__ . '/models/database/project/NewProject.php';
include_once __PROJECTROOT__ . '/models/database/project/ProjectInfo.php';
include_once __PROJECTROOT__ . '/models/database/project/JoinProject.php';
include_once __PROJECTROOT__ . '/models/database/project/DeleteProject.php';
require_once __PROJECTROOT__ . '/models/database/project/DisjoinProject.php';
include_once __PROJECTROOT__ . '/models/database/project/ModifyProject.php';
include_once __PROJECTROOT__ . '/models/database/movimento/Movimento.php';
include_once __PROJECTROOT__ . '/models/database/project/UserProject.php';
include_once __PROJECTROOT__ . '/models/database/user/UserInfo.php';
include_once __PROJECTROOT__ . '/models/database/tag/TagInfo.php';
$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$projectManager = new ProjectInfo($database);
$joinProget = new JoinProject($database);
$projectDel = new DeleteProject($database);
$projectDJ = new DisjoinProject($database);
$projectNew = new NewProject($database);
$modProject = new ModifyProject($database);

$movimentoDb = new Movimento($database);
$projectDb = new UserProject($database);
$userDb = new UserInfo($database);
$tagDb = new TagInfo($database);

function isLogged(): bool
{
	global $userDb;
	if (isset($_SESSION['LogIn'])) {
		$data = json_decode($_SESSION['LogIn'], true);
		$logged = $userDb->existsByEmail($data['email']);
		if ($logged) {
			return true;
		}
	}
	return false;
}

function isUserInProject($projectId): bool
{
	global $projectDb;
	global $userDb;
	$data = json_decode($_SESSION['LogIn'], true);
	$userId = $userDb->getId($data['email']);
	$inProject = $projectDb->isUserInProject($userId, $projectId);
	if ($inProject) {
		return true;
	}
	return false;
}

function checkPassword($password): bool
{
    global $userDb;
    $data = json_decode($_SESSION['LogIn'], true);
    return $userDb->checkCredentials($data['email'], $password);
}