<?php
require_once ('Project.php');
class ProjectInfo extends Project {
    public function __construct(Database $db) {
        parent::__construct($db);
    }
    public function exists($projectId) : bool {
        $sql = "SELECT * FROM progetto WHERE id = ?";
        $params = [
            ['type' => 'i', 'value' => $projectId]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        return $stmt->get_result()->num_rows > 0;
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

        return $stmt->get_result()->num_rows > 0;
    }
}
