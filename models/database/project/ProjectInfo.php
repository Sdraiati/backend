<?php
define('__PROJECTROOT__', dirname(__FILE__, 4));
require_once(__PROJECTROOT__.'/api/config/database.php');
class ProjectInfo {
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function isProjectOwner($projectId, $email) : bool {
        // check if the user exists
        if (!$this->userInfo->exists($email))
            die("ProjectInfo: user not found with email $email");

        $sql = "SELECT * FROM progetto_utente WHERE id_progetto = ? AND email = ?";

        $params = [
            ['type' => 'i', 'value' => $projectId],
            ['type' => 's', 'value' => $email]
        ];

        $stmt = $this->db->prepareAndBindParams($sql, $params);

        $stmt->execute() or die($stmt->error);

        return $stmt->num_rows > 0;
    }
}
