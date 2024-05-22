<?php

require_once("direct.php");

$routes = array(
    "/about_us" => function($method, $logged) {
        generalPage($method, $logged);
    },
    "/account_home" => function($method, $logged) {
        account_home($method, $logged);
    },
    "/" => function($method, $logged) {
		$_SERVER['REQUEST_URI'] = "/index";
        generalPage($method, $logged);
    },
    "/index" => function($method, $logged) {
        generalPage($method, $logged);
    },
    "/registration" => function($method, $_)
    {
        registration($method);
    },
    "/access" => function($method, $_)
    {
        access($method);
    },
    "/modifyCredentials" => function($method, $_)
    {
        modifyCredentials($method);
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
