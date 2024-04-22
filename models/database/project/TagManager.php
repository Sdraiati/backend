<?php
require_once('Database.php');

class TagManager {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getTagId($tagName, $projectId) {
        $sql = "SELECT id FROM tag WHERE nome = '$tagName' AND id_progetto = '$projectId'";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['id'];
        } else {
            return null;
        }
    }

    public function addTag($tagName, $projectId) {
        // Controlla se il tag esiste già per il progetto
        if (!$this->tagExists($tagName, $projectId)) {
            $sql = "INSERT INTO tag (nome, id_progetto) VALUES ('$tagName', '$projectId')";
            $this->db->query($sql);
            return $this->db->getLastInsertId();
        } else {
            // Il tag esiste già, restituisci l'ID
            return $this->getTagId($tagName, $projectId);
        }
    }

    private function tagExists($tagName, $projectId) {
        $sql = "SELECT id FROM tag WHERE nome = '$tagName' AND id_progetto = '$projectId'";
        $result = $this->db->query($sql);
        return $result->num_rows > 0;
    }
}
?>
