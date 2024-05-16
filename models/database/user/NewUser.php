<?php
define('__NEWUSERROOT__', dirname(__FILE__, 4));
require_once (__PROJECTROOT__.'/models/database/DatabaseManager.php');
class NewUser extends DatabaseManager {
    public function __construct(Database $db) {
        parent::__construct($db);
    }

    public function createUser($email, $username, $password) : bool {
        $sql = "INSERT INTO utente (email, username, password) VALUES (?, ?, ?)";

        $params = [
            ['type' => 's', 'value' => $email],
            ['type' => 's', 'value' => $username],
            ['type' => 's', 'value' => $password]
        ];

        $stmt = $this->db->prepareAndBindParams($sql, $params);

        $stmt->execute() or die($stmt->error);

        return true;
    }
}