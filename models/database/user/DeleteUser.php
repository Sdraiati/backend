<?php
require_once ('User.php');
class DeleteUser extends User {
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