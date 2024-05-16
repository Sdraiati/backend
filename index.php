<?php

//require_once("controllers/Controller.php");
//require_once("models/database/project/NewProject.php");
//require_once("models/database/user/NewUser.php");
//require_once("api/config/database.php");
//require_once("api/config/db_config.php");
require_once("routes.php");

function formatUrl($stringa) {
    $posizionePunto = strpos($stringa, '.');
    
    if ($posizionePunto !== false) {
        return substr($stringa, 0, $posizionePunto);
    } else {
        return $stringa;
    }
}

session_start();
//$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
//$controller = new Controller();

$logged = isset($_COOKIE["logIn"]);
if($logged) {$_SESSION["LogIn"] = $_COOKIE["LogIn"];}
$url = formatUrl($_SERVER['REQUEST_URI']);


if(array_key_exists($url, $routes))
{
    $logged = isset($_COOKIE["logIn"]);
    if($logged) {$_SESSION["LogIn"] = $_COOKIE["LogIn"];}
    $fun = $routes[$url];
    $fun($_SERVER['REQUEST_METHOD'], $logged);
}
else{
    $controller->renderPage("resource_not_found", $logged); 
}



/*
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
            header("Location: /account_home");
        }
        else{
            $controller->renderPage(formatUrl($_SERVER['REQUEST_URI']), isset($_COOKIE["logIn"]));
        }
    }
    else if($_SERVER['REQUEST_URI']=="/registration")
    {
        $newUser = new NewUser($database);
        $newUser->createUser($_POST['email'], $_POST['username'], $_POST['password']);
        $_COOKIE["LogIn"] = ["email"=>$_POST['email'], "username"=>$_POST['username'], "password"=>$_POST['password']];
        $_SESSION["LogIn"] = ["email"=>$_POST['email'], "username"=>$_POST['username'], "password"=>$_POST['password']];
        header("Location: /account_home");
    }
}
else{
    $controller->renderPage("resource_not_found", isset($_COOKIE["logIn"]));
}*/