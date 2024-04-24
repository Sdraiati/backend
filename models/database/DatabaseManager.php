<?php
define('__DATABASEMANAGERROOT__', dirname(__FILE__, 3));
require_once(__DATABASEMANAGERROOT__.'/api/config/database.php');

class DatabaseManager {
    protected Database $db;

    protected function __construct(Database $db) {
        $this->db = $db;
    }
}