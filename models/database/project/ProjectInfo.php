<?php
define('__PROJECTINFOROOT__', dirname(__FILE__, 4));
require_once (__PROJECTROOT__.'/models/database/DatabaseManager.php');
class ProjectInfo extends DatabaseManager {
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function exists($projectId): bool {
        $sql = "SELECT * FROM progetto WHERE id = ?";
        $params = [
            ['type' => 'i', 'value' => $projectId]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        return $stmt->get_result()->num_rows > 0;
    }
}