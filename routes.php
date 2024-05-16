<?php

require_once("direct.php");

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