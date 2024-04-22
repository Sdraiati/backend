<?php
define('__ROOT__', dirname(dirname(dirname(dirname(__FILE__)))));
require_once(__ROOT__.'/api/config/database.php');

require_once (__ROOT__.'/models/database/user/UserInfo.php');

class NewProject {
    private $db;
    private $userInfo;

    public function __construct(Database $db) {
        $this->db = $db;
        $this->userInfo = new UserInfo($db);
    }

    public function createProject($email, $nome, $link_condivisione, $descrizione='') : bool {
        // check if the user exists
        if (!$this->userInfo->exists($email))
            die("createProject: user not found with email $email");

        $sql_progetto = "INSERT INTO progetto (nome, link_condivisione, descrizione) VALUES (?, ?, ?)";

        $params = [
            ['type' => 's', 'value' => $nome],
            ['type' => 's', 'value' => $link_condivisione],
            ['type' => 's', 'value' => $descrizione]
        ];

        $stmt = $this->db->prepareAndBindParams($sql_progetto, $params);

        $stmt->execute() or die($stmt->error);

        return true;
    }
}