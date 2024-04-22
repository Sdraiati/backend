<?php
define('__PROJECTROOT__', dirname(__FILE__, 4));
require_once(__PROJECTROOT__.'/api/config/database.php');

require_once (__PROJECTROOT__.'/models/database/user/UserInfo.php');

class TagInfo {
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function createTag($id_progetto, $nome, $descrizione='') : bool {

        $sql_tag = "INSERT INTO tag (id_progetto, nome, descrizione) VALUES (?, ?, ?)";

        $params = [
            ['type' => 'i', 'value' => $id_progetto],
            ['type' => 's', 'value' => $nome],
            ['type' => 's', 'value' => $descrizione]
        ];

        $stmt = $this->db->prepareAndBindParams($sql_tag, $params);

        $stmt->execute() or die($stmt->error);

        return true;
    }
}
