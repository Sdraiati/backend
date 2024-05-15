<?php
define('__USERROOT__', dirname(__FILE__, 4));
require_once (__PROJECTROOT__.'/models/database/DatabaseManager.php');

class UserInfo extends DatabaseManager {
    public function __construct(Database $db) {
        parent::__construct($db);
    }
    public function exists(string $email) : bool {
        $sql = "SELECT * FROM utente WHERE email = '$email'";
        $result = $this->db->query($sql);
        return $result->num_rows > 0;
    }
}
