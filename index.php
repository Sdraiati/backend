<?php

include "controllers/Controller.php";
include "models/database/project/NewProject.php";
include "config/database.php";
include "config/db_config.php";

/*L'UNICO SCOPO DI QUESTA FUNZIONE E' QUELLA DI TOGLIERE I PUNTI .HTML, .PHP 
DAI LINK VISTO CHE LE PROVE CHE FACCIO IN LOCALE NON SFRUTTANO APACHE,
IN CASO DOVESSE SMETTERE DI SERVIRE, BASTERA LETTERALMENTE SCRIVERE "$controller->renderPage($url);" AL POSTO DI "$controller->renderPage(formatUrl($url));"
*/

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
$newProject = new NewProject($database);

if($_SERVER['REQUEST_METHOD'] == "GET")
{
    try{
        $url = str_replace("/backend/", "", $_SERVER['REQUEST_URI']);
        $controller->renderPage(formatUrl($url));
    }catch (Exception $e) {
        $controller->renderPage("resource_not_found"); 
    }  
}
else if($_SERVER['REQUEST_METHOD'] == "POST" && $_SERVER['REQUEST_URI']=="/backend/project_creation")
{
    $error_message = '';
    try{
        $nome = 'risparmio1';
        $descrizione = 'provaprova';
        $email = 'simone@mail.com';
        $link_condivisione = 'ciaooo.com';

        $newProject->createProject($email, $nome, $link_condivisione, $descrizione);
    }
    catch(Exception $e)
    {
        $error_message = $e->getMessage();
    }
    if ($error_message != '') {
        echo "<h1>Errore:</h1>";
        echo "<p>" . $error_message . "</p>";
    }
}
else{
    print $_SERVER['REQUEST_URI'];
}