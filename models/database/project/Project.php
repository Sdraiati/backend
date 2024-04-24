<?php
define('__PROJECTROOT__', dirname(__FILE__, 4));
require_once(__PROJECTROOT__.'/api/config/database.php');

class Project {
    protected Database $db;

    protected function __construct(Database $db) {
        $this->db = $db;
    }
}