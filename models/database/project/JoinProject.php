<?php
require_once ('UserProject.php');
class JoinProject extends UserProject {
    protected UserInfo $userInfo;
    protected ProjectInfo $projectInfo;
    public function __construct(Database $db) {
        parent::__construct($db);
    }

    public function joinProject($email, $project_id) : bool {
        // check if the user exists
        if (!$this->userInfo->exists($email))
            die("joinProject: user not found with email $email");

        // check if the project exists
        if (!$this->projectInfo->exists($project_id))
            die("joinProject: project not found with id $project_id");

        $sql = "INSERT INTO progetto_utente (id_progetto, email) VALUES (?, ?)";
        $params = [
            ['type' => 'i', 'value' => $project_id],
            ['type' => 's', 'value' => $email]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);

        return true;
    }
}
