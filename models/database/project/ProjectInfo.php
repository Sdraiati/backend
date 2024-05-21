<?php
define('__PROJECTINFOROOT__', dirname(__FILE__, 4));
require_once (__PROJECTINFOROOT__.'/models/database/DatabaseManager.php');
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

    public function getProjectInfo($projectId): array {
        $sql = "SELECT * FROM progetto WHERE id = ?";
        $params = [
            ['type' => 'i', 'value' => $projectId]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        return $stmt->get_result()->fetch_assoc();
    }

    public function getProjectList(): array
    {
        $sql_list = "SELECT id FROM progetto";
        $stmt_list = $this->db->query($sql_list);
        $project_list = [];
        while ($row = $stmt_list->fetch_assoc()) {
            $sql = "SELECT * FROM progetto WHERE id = ?";
            $params = [
                ['type' => 'i', 'value' => $row['id']]
            ];
            $stmt = $this->db->prepareAndBindParams($sql, $params);
            $stmt->execute() or die($stmt->error);
            $project_list[] = $stmt->get_result()->fetch_assoc();
        }
        return $project_list;
    }
}