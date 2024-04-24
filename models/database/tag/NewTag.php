<?php
require_once ('Tag.php');
class NewTag extends Tag {
    public function __construct(Database $db) {
        parent::__construct($db);
    }

    public function createTag($projectId, $tagName, $tagDescription='') : bool {

        $sql_tag = "INSERT INTO tag (id_progetto, nome, descrizione) VALUES (?, ?, ?)";

        $params = [
            ['type' => 'i', 'value' => $projectId],
            ['type' => 's', 'value' => $tagName],
            ['type' => 's', 'value' => $tagDescription]
        ];

        $stmt = $this->db->prepareAndBindParams($sql_tag, $params);

        $stmt->execute() or die($stmt->error);

        return true;
    }
}
