<?php
define('__PROJECTROOT__', dirname(__FILE__, 4));
require_once (__PROJECTROOT__.'/models/database/DatabaseManager.php');
class DeleteTag extends DatabaseManager {
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function deleteTag($projectId, $tagId) : bool {
        $sql = "DELETE FROM tag WHERE id_progetto = ? AND id = ?";

        $params = [
            ['type' => 'i', 'value' => $projectId],
            ['type' => 'i', 'value' => $tagId]
        ];

        $stmt = $this->db->prepareAndBindParams($sql, $params);

        $stmt->execute() or die($stmt->error);

        return true;
    }
}