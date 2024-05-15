<?php
require_once ('UserProject.php');

class NewProject extends UserProject {
    public function __construct(Database $db) {
        parent::__construct($db);
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

        // insert the project into the progetto_utente table
        $project_id = $stmt->insert_id;
        $sql_progetto_utente = "INSERT INTO progetto_utente (id_progetto, email) VALUES (?, ?)";

        $params = [
            ['type' => 'i', 'value' => $project_id],
            ['type' => 's', 'value' => $email]
        ];

        $stmt = $this->db->prepareAndBindParams($sql_progetto_utente, $params);

        $stmt->execute() or die($stmt->error);

        return true;
    }
}