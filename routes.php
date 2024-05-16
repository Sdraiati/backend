<?php

require_once("controllers/Controller.php");
require_once("api/config/database.php");
require_once("api/config/db_config.php");
require_once("models/database/project/NewProject.php");
require_once("models/database/user/NewUser.php");


$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$controller = new Controller();

function generalPage($_, $logged)
{
    global $controller;
    $controller->renderPage(formatUrl($_SERVER['REQUEST_URI']), $logged);
}

function registration($method, $logged)
{
    global $controller;
    global $database;
    if($method == "POST")
    {
        $newUser = new NewUser($database);
        $newUser->createUser($_POST['email'], $_POST['username'], $_POST['password']);
        $_COOKIE["LogIn"] = ["email"=>$_POST['email'], "username"=>$_POST['username'], "password"=>$_POST['password']];
        $_SESSION["LogIn"] = ["email"=>$_POST['email'], "username"=>$_POST['username'], "password"=>$_POST['password']];
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
            $email = $_SESSION["LogIn"]["email"];
            $link_condivisione = 'bho2';
            $newProject = new NewProject($database);
            $newProject->createProject($email, $nome, $link_condivisione, $descrizione);
            header("Location: /account_home");
        }
        else{
            $controller->renderPage(formatUrl($_SERVER['REQUEST_URI']), isset($_COOKIE["logIn"]));
        }
    }
    else if($method == "GET")
    {
        //lista progetti
        $controller->renderPage(formatUrl($_SERVER['REQUEST_URI']), $logged);
    }
}

$routes = array(
    "/about_us" => function($method, $logged) {
        generalPage($method, $logged);
    },
    "/account_home" => function($method, $logged) {
        account_home($method, $logged);
    },
    "/index" => function($method, $logged) {
        generalPage($method, $logged);
    },
    "/registration" => function($method, $logged)
    {
        registration($method, $logged);
    },
    "/project_cake" => function($method, $logged) {
        generalPage($method, $logged);
    },
    "/project_home" => function($method, $logged) {
        generalPage($method, $logged);
    },
    "/project_shared" => function($method, $logged) {
        generalPage($method, $logged);
    },
    "/release_notes" => function($method, $logged) {
        generalPage($method, $logged);
    }
);
?>