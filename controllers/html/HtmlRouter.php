<?php

include_once 'HtmlApi.php';
include_once 'SpecialHtmlApi.php';
include_once __PROJECTROOT__ . '/api/config/db_config.php';
include_once __PROJECTROOT__ . '/api/config/database.php';
require_once("models/database/project/ProjectInfo.php");

$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$project_manager = new ProjectInfo($database);

$about_us = new HtmlApi('about_us');
$index = new HtmlApi('');
$index2 = new HtmlApi('index');
$project_cake = new HtmlApi('project_cake');
$project_home = new HtmlApi('project_home');
$release_notes = new HtmlApi('release_notes');

