<?php
require_once ('User.php');
class NewUser extends User {
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