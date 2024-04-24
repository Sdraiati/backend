<?php
define('__USERROOT__', dirname(__FILE__, 4));
require_once(__USERROOT__.'/api/config/database.php');

require_once (__USERROOT__.'/models/database/user/UserInfo.php');

class User {
    protected Database $db;

    protected function __construct(Database $db) {
        $this->db = $db;
    }
}