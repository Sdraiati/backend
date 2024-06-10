<?php
require_once ('UserProject.php');
class DisjoinProject extends UserProject
{
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function disjoinProject($email, $projectId) : string | bool
    {
        // check if user exists
        if (!$this->userInfo->existsByEmail($email))
            die("disjoinProject: user not found with email $email");
        // check if project exists
        if (!$this->projectInfo->exists($projectId))
            die("disjoinProject: project not found with id $projectId");
        // get id of the user
        $userId = $this->userInfo->getId($email);
        // check if user is in the project
        if (!$this->isUserInProject($userId, $projectId))
            die("disjoinProject: user $userId is not in project $projectId");
        // check if the project has only one owner
        if ($this->isProjectOnlyOwner($userId, $projectId)){
            return "You are the only owner of the project. You can't leave the project.";
        }

        $sql = "DELETE FROM progetto_utente WHERE id_progetto = ? AND id_utente = ?";
        $params = [
            ['type' => 'i', 'value' => $projectId],
            ['type' => 'i', 'value' => $userId]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);

        return true;
    }
}