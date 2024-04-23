<?php
require_once ('Tag.php');
class TagInfo extends Tag {
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function hasTag($projectId, $tagId): bool {
        $sql = "SELECT * FROM tag WHERE id_progetto = ? AND id = ?";

        $params = [
            ['type' => 'i', 'value' => $projectId],
            ['type' => 'i', 'value' => $tagId]
        ];

        $stmt = $this->db->prepareAndBindParams($sql, $params);

        $stmt->execute() or die($stmt->error);

        return $stmt->get_result()->num_rows > 0;
    }
}