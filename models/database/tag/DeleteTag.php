<?php
define('__GROOT__', dirname(__FILE__, 4));
require_once (__GROOT__.'/models/database/DatabaseManager.php');
class DeleteTag extends DatabaseManager {
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function deleteTag($tagId) : bool {
        $sql = "DELETE FROM tag WHERE id = ?";

        $params = [
            ['type' => 'i', 'value' => $tagId]
        ];

        $stmt = $this->db->prepareAndBindParams($sql, $params);

        $stmt->execute() or die($stmt->error);

        return true;
    }
}