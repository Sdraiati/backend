<?php

include "controllers/Controller.php";

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

$controller = new Controller();

if($_SERVER['REQUEST_METHOD'] == "GET")
{
    try{
        $url = str_replace("/backend/", "", $_SERVER['REQUEST_URI']);
        $controller->renderPage(formatUrl($url));
    }catch (Exception $e) {
        $controller->renderPage("resource_not_found"); 
    }  
}