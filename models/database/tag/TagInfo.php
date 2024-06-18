<?php
define('__TROOT__', dirname(__FILE__, 4));
require_once (__TROOT__.'/models/database/DatabaseManager.php');
class TagInfo extends DatabaseManager {
    public function __construct(Database $db) {
        parent::__construct($db);
    }

    public function getTagsByIdProgetto($projectId) {
        $query = "SELECT tag.id, tag.nome, tag.descrizione FROM tag
			WHERE tag.id_progetto = ?";

        $params = [
            ['type' => 'i', 'value' => $projectId],
        ];

        $stmt = $this->db->prepareAndBindParams($sql, $params);

        $stmt->execute() or die($stmt->error);

        return $result->fetch_assoc();
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

    public function getIdByName($projectId, $tagName): int {
        $sql = "SELECT id FROM tag WHERE id_progetto = ? AND nome = ?";

        $params = [
            ['type' => 'i', 'value' => $projectId],
            ['type' => 's', 'value' => $tagName]
        ];

        $stmt = $this->db->prepareAndBindParams($sql, $params);

        $stmt->execute() or die($stmt->error);

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc()['id'];
        } else {
            return -1;
        }
    }
}