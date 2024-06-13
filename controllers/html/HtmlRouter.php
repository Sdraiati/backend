<?php

include_once 'HtmlApi.php';
include_once 'AccountHomeHtmlApi.php';
include_once 'ProjectSharedHtmlApi.php';
include_once 'IndexHtmlApi.php';
include_once 'ProjectHomeHtmlApi.php';

$about_us = new HtmlApi('about_us');
$release_notes = new HtmlApi('release_notes');

$index = new IndexHtmlApi('');
$account_home = new AccountHomeHtmlApi('account_home');
$project_shared = new ProjectSharedHtmlApi('project_shared');
$project_home = new ProjectHomeHtmlApi('project_home');
$project_cake = new ProjectHomeHtmlApi('project_cake');

$html_router = new Router();
$html_router->addRoute($about_us);
$html_router->addRoute($index);
$html_router->addRoute($project_home);
$html_router->addRoute($release_notes);
$html_router->addRoute($account_home);
$html_router->addRoute($project_shared);
$html_router->addRoute($project_home);
$html_router->addRoute($project_cake);
