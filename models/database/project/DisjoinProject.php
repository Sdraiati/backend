<?php
require_once ('UserProject.php');
class DisjoinProject extends UserProject
{
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }

    public function disjoinProject($userId, $projectId)
    {
        // check if user exists
        if (!$this->userInfo->exists($userId))
            die("disjoinProject: user not found with id $userId");
        // check if project exists
        if (!$this->projectInfo->exists($projectId))
            die("disjoinProject: project not found with id $projectId");
        // check if user is in the project
        if (!$this->isUserInProject($userId, $projectId))
            die("disjoinProject: user $userId is not in project $projectId");

        $sql = "DELETE FROM progetto_utente WHERE id_progetto = ? AND email = ?";
        $params = [
            ['type' => 'i', 'value' => $projectId],
            ['type' => 's', 'value' => $userId]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);

        return true;
    }
}