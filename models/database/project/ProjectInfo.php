<?php
define('__PROJECTROOT__', dirname(__FILE__, 4));
require_once(__PROJECTROOT__.'/api/config/database.php');
class ProjectInfo {
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function isProjectOwner($projectId, $email) : bool {
        $sql = "SELECT * FROM progetto_utente WHERE id_progetto = '$projectId' AND email = '$email'";
        $result = $this->db->query($sql);
        return mysqli_num_rows($result) > 0;
    }
}
