<?php
require_once ('Project.php');
class DeleteProject extends Project {
    public function __construct(Database $db) {
        parent::__construct($db);
    }

    public function deleteProject($project_id) : bool {
        $sql = "DELETE FROM progetto WHERE id = ?";
        $params = [
            ['type' => 'i', 'value' => $project_id]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        return true;
    }
}