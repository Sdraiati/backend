<?php
require_once("controllers/Controller.php");
require_once("api/config/database.php");
require_once("api/config/db_config.php");
require_once("models/database/project/NewProject.php");
require_once("models/database/project/ProjectInfo.php");
require_once("models/database/project/JoinProject.php");
require_once("models/database/project/DeleteProject.php");
require_once("models/database/project/DisjoinProject.php");
require_once("models/database/user/NewUser.php");
require_once("models/database/user/UserInfo.php");
require_once("models/database/user/ModifyUser.php");
require_once("models/SetCookie.php");

function formatUrl($url)
{
	$stringa = explode('?', $url)[0];
	$posizionePunto = strpos($stringa, '.');

	if ($posizionePunto !== false) {
		return substr($stringa, 0, $posizionePunto);
	} else {
		return $stringa;
	}
}

function randomString($lunghezza = 10, $caratteri = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
	$stringaCasuale = '';
	$numeroCaratteri = strlen($caratteri);

	for ($i = 0; $i < $lunghezza; $i++) {
		$stringaCasuale .= $caratteri[rand(0, $numeroCaratteri - 1)];
	}

	return $stringaCasuale;
}


$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$controller = new Controller();
$projectManager = new ProjectInfo($database);
$joinProget = new JoinProject($database);
$projectDel = new DeleteProject($database);
$projectDJ = new DisjoinProject($database);

function generalPage($_, $logged)
{
	global $controller;
	$controller->renderPage(formatUrl($_SERVER['REQUEST_URI']), $logged);
}


function registration($method)//POST
{
	global $database;
	if ($method == "POST") {
		try{
			$newUser = new NewUser($database);
			$datas = json_decode(file_get_contents('php://input'), true);
			$newUser->createUser($datas['email'], $datas['username'], $datas['password']);
			setCookieUser($datas['email'], $datas['username'], $datas['password']);
			$data_content = array('status' => 'success');
		}
		catch(Exception $e)
		{
			$data_content = array('status' => $e->getMessage());
		}
		$json = json_encode($data_content);
    	echo $json;
	}
}

function access($method)//POST
{
	global $database;
	
	if ($method == "POST") {
		$check = new UserInfo($database);
		$datas = json_decode(file_get_contents('php://input'), true);
		if ($check->checkCredentials($datas['email'], $datas['password'])) {
			$data = $check->getUser($datas['email']);
			setCookieUser($data['email'], $data['username'], $data['password']);
			$data_content = array('status' => 'success');
		} else {
			$data_content = array('status' => "wrong credentials");
		}
		header('Content-Type: application/json');
    	echo json_encode($data_content);
	}
}

function modifyCredentials($method)//POST
{
	global $database;
	if ($method == "POST") {
		try{
			$data = json_decode(file_get_contents('php://input'), true);
			$mod = new ModifyUser($database);
			$email = json_decode($_SESSION["LogIn"], true)["email"];
			$password = json_decode($_SESSION["LogIn"], true)["password"];
			$mod->modify($email, $password, ['email' => $data['newEmail'], 'username' => $data['newUsername'], 'password' => $data['newPassword']]);
			setCookieUser($data['newEmail'], $data['newUsername'], $data['newPassword']);
			$data_content = array('status' => 'success');
		}
		catch(Exception $e)
		{
			$data_content = array('status' => $e->getMessage());
		}
		$json = json_encode($data_content);
		header('Content-Type: application/json');
    	echo $json;
	}
}
function deleteProject($_, $logged)
{
    global $projectManager;
    global $projectDel;
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $id_project = $projectManager->getIDProjectByLink($data['link']);
        $projectDel->deleteProject($id_project);
        $data_content = array('status' => 'success');
    } catch (Exception $e) {
        $data_content = array('status' => $e->getMessage());
    }
    $json = json_encode($data_content);
	header('Content-Type: application/json');
    echo $json;
}
function disjoinProject($_, $logged)
{
    global $projectManager;
    global $projectDJ;
    $email = json_decode($_SESSION["LogIn"], true)["email"];
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $id_project = $projectManager->getIDProjectByLink($data['link']);
        $projectDJ->disjoinProject($email, $id_project);
        $data_content = array('status' => 'success');
        error_log("disjoinProject: success!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
    } catch (Exception $e) {
        $data_content = array('status' => $e->getMessage());
    }
    $json = json_encode($data_content);
	header('Content-Type: application/json');
    echo $json;
}
function account_home($method, $logged)
{
	global $controller;
	global $database;
	if ($method == "POST") {//TRY CATCH E JAVASCRIPT
		if (isset($_SESSION["LogIn"])) {
			$datas = json_decode(file_get_contents('php://input'), true);
			try{
				$nome = $datas["nomeProgetto"];
				$descrizione = $datas["descrizioneProgetto"];
				$email = json_decode($_SESSION["LogIn"], true)["email"];
				$link_condivisione = randomString(10);
				$newProject = new NewProject($database);
				$newProject->createProject($email, $nome, $link_condivisione, $descrizione);
				$data_content = array('status' => 'success');
			}
			catch(Exception $e)
			{
				$data_content = array('status' => $e->getMessage());
			}
			$json = json_encode($data_content);
			header('Content-Type: application/json');
			echo $json;
		} else {
			$controller->renderPage(formatUrl($_SERVER['REQUEST_URI']), $logged);
		}
	} else if ($method == "GET") {
		global $controller;
		global $database;
		$projectManager = new ProjectInfo($database);
		$controller->renderProjectPage(formatUrl($_SERVER['REQUEST_URI']), $logged, $projectManager);
	}
}

function project_shared($_, $logged)//GET
{
    global $controller;
    global $projectManager;
    $project = $projectManager->getProjectInfoByLink($_GET['link']);
	$controller->renderProjectSharedPage(formatUrl($_SERVER['REQUEST_URI']), $logged, $project);
}

function joinProject($_, $logged)//POST
{
	global $projectManager;
	global $joinProget;
	$email = json_decode($_SESSION["LogIn"], true)["email"];
	$datas = json_decode(file_get_contents('php://input'), true);
	try{
		$project = $projectManager->getProjectInfoByLink($datas['link']);
		$joinProget->joinProject($email, $project['id']);
		$data_content = array('status' => 'success');
	}catch(Exception $e){
		$data_content = array('status' => $e->getMessage());
	}
	$json  = json_encode($data_content);
	header('Content-Type: application/json');
	echo $json ;
}
?>