<?php
define('__PROJECTROOT__', dirname(__FILE__, 4));
require_once (__PROJECTROOT__.'/models/database/DatabaseManager.php');
class DeleteProject extends DatabaseManager {
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