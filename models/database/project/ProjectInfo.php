<?php
require_once ('Project.php');
class ProjectInfo extends Project
{
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function exists($projectId): bool
    {
        $sql = "SELECT * FROM progetto WHERE id = ?";
        $params = [
            ['type' => 'i', 'value' => $projectId]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        return $stmt->get_result()->num_rows > 0;
    }
}