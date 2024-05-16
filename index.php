<?php

require_once("controllers/Controller.php");
require_once("models/database/project/NewProject.php");
require_once("api/config/database.php");
require_once("api/config/db_config.php");

function formatUrl($stringa) {
    $posizionePunto = strpos($stringa, '.');
    
    if ($posizionePunto !== false) {
        return substr($stringa, 0, $posizionePunto);
    } else {
        return $stringa;
    }
}

session_start();
$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$controller = new Controller();

if($_SERVER['REQUEST_METHOD'] == "GET")
{
    $logged = isset($_COOKIE["logIn"]);
    if($logged) {$_SESSION["LogIn"] = $_COOKIE["LogIn"];}
    try{
        $controller->renderPage(formatUrl($_SERVER['REQUEST_URI']), $logged);
    }catch (Exception $e) {
        $controller->renderPage("resource_not_found", $logged); 
    }  
}
else if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if($_SERVER['REQUEST_URI']=="/account_home")
    {
        if(isset($_SESSION["LogIn"]))
        {
            $nome = $_POST["nomeProgetto"];
            $descrizione = $_POST["descrizioneProgetto"];
            $email = $_SESSION["LogIn"]["email"];
            $link_condivisione = 'bho';
            $newProject = new NewProject($database);
            $newProject->createProject($email, $nome, $link_condivisione, $descrizione);
        }
        else{
            $controller->renderPage(formatUrl($_SERVER['REQUEST_URI']), isset($_COOKIE["logIn"]));
        }
    }
}
else{
    $controller->renderPage("resource_not_found", isset($_COOKIE["logIn"]));
}