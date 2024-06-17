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
    // "/user/login" => function($method, $_)
    // {
    //     access($method);
    // },
    "/modifyCredentials" => function($method, $_)
    {
        modifyCredentials($method);
    },
    "/delete_project" => function($method, $logged)
    {
        deleteProject($method, $logged);
    },
    "/disjoin_project" => function($method, $logged)
    {
        disjoinProject($method, $logged);
    },
    "/project_cake" => function($method, $logged) {
        generalPage($method, $logged);
    },
    "/project_home" => function($method, $logged) {
        generalPage($method, $logged);
    },
    "/project_shared" => function($method, $logged) {
        project_shared($method, $logged);
    },
    "/release_notes" => function($method, $logged) {
        generalPage($method, $logged);
    },
    "/join_project" => function($method, $logged)
    {
        joinProject($method, $logged);
    }
);
?>
