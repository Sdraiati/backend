<?php
define('__PROJECTROOT__', dirname(__FILE__, 4));
require_once(__PROJECTROOT__.'/api/config/database.php');

require_once (__PROJECTROOT__.'/models/database/user/UserInfo.php');

class Tag {
    protected Database $db;

    protected function __construct(Database $db) {
        $this->db = $db;
    }
}