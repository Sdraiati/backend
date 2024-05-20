<?php

require_once("controllers/Controller.php");
require_once("api/config/database.php");
require_once("api/config/db_config.php");
require_once("models/database/project/NewProject.php");
//require_once("models/database/project/ListProject.php");
require_once("models/database/user/NewUser.php");

function formatUrl($stringa) {
    $posizionePunto = strpos($stringa, '.');
    
    if ($posizionePunto !== false) {
        return substr($stringa, 0, $posizionePunto);
    } else {
        return $stringa;
    }
}


$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$controller = new Controller();

function generalPage($_, $logged)
{
    global $controller;
    $controller->renderPage(formatUrl($_SERVER['REQUEST_URI']), $logged);
}

function registration($method)
{
    global $database;
    if($method == "POST")
    {
        $newUser = new NewUser($database);
        $newUser->createUser($_POST['email'], $_POST['username'], $_POST['password']);
        $cookieValue = ["email"=>$_POST['email'], "username"=>$_POST['username'], "password"=>$_POST['password']];
        setcookie("LogIn", json_encode($cookieValue), time() + (86400 * 30), "/");
        $_SESSION["LogIn"] = $cookieValue;
        header("Location: /account_home");
    }
}
function account_home($method, $logged)
{
    global $controller;
    global $database;
    if($method == "POST")
    {
        if(isset($_SESSION["LogIn"]))
        {
            $nome = $_POST["nomeProgetto"];
            $descrizione = $_POST["descrizioneProgetto"];
            $email = json_decode($_SESSION["LogIn"], true)["email"];
            $link_condivisione = 'bho3';
            $newProject = new NewProject($database);
            $newProject->createProject($email, $nome, $link_condivisione, $descrizione);
            header("Location: /account_home");
        }
        else{
            $controller->renderPage(formatUrl($_SERVER['REQUEST_URI']), $logged);
        }
    }
    else if($method == "GET")
    {
        $project_list = array();
        //$project_list = new ListProject();
        //$project_list->renderProjectPage();
        $controller->renderProjectPage(formatUrl($_SERVER['REQUEST_URI']), $logged, $project_list);
    }
}