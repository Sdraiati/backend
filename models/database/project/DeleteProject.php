<?php
require_once ('Project.php');
require_once (__PROJECTROOT__.'/models/database/tag/DeleteTag.php');
class DeleteProject extends Project {
    private DeleteTag $deleteTag;

    public function __construct(Database $db) {
        parent::__construct($db);
        $this->deleteTag = new DeleteTag($db);
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