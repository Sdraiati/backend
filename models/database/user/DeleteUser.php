<?php
define('__USERROOT__', dirname(__FILE__, 4));
require_once (__PROJECTROOT__.'/models/database/DatabaseManager.php');
class DeleteUser extends DatabaseManager {
    public function __construct(Database $db) {
        parent::__construct($db);
    }

    public function deleteUser($email) : bool {
        $sql = "DELETE FROM utente WHERE email = ?";

        $params = [
            ['type' => 's', 'value' => $email]
        ];

        $stmt = $this->db->prepareAndBindParams($sql, $params);

        $stmt->execute() or die($stmt->error);

        return true;
    }
}