<?php

require_once (__PROJECTROOT__.'/models/database/DatabaseManager.php');
require_once (__PROJECTROOT__.'/models/database/user/UserInfo.php');
require_once (__PROJECTROOT__.'/models/database/project/ProjectInfo.php');

class UserProject extends DatabaseManager {
    protected UserInfo $userInfo;
    protected ProjectInfo $projectInfo;

    protected function __construct(Database $db)
    {
        parent::__construct($db);
        $this->userInfo = new UserInfo($db);
        $this->projectInfo = new ProjectInfo($db);
    }

    protected function isUserInProject($userId, $projectId)
    {
        // check if user exists
        if (!$this->userInfo->exists($userId)) {
            die("isUserInProject: user not found with id $userId");
        }
        // check if project exists
        if (!$this->projectInfo->exists($projectId)) {
            die("isUserInProject: project not found with id $projectId");
        }

        $sql = "SELECT * FROM progetto_utente WHERE id_progetto = ? AND id_utente = ?";
        $params = [
            ['type' => 'i', 'value' => $projectId],
            ['type' => 'i', 'value' => $userId]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        return $stmt->get_result()->num_rows > 0;
    }
    // Check if the project has only one owner
    protected function isProjectOnlyOwner($userId, $projectId) : bool {
        // check if user exists
        if (!$this->userInfo->exists($userId))
            die("isProjectOwner: user not found with id $userId");
        // check if project exists
        if (!$this->projectInfo->exists($projectId))
            die("isProjectOwner: project not found with id $projectId");
        // check if user is in the project
        if (!$this->isUserInProject($userId, $projectId))
            die("isProjectOwner: user $userId is not in project $projectId");

        $sql = "SELECT * FROM progetto_utente WHERE id_progetto = ?";
        $params = [
            ['type' => 'i', 'value' => $projectId]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);
        return $stmt->get_result()->num_rows == 1;
    }
    public function modify(string $oldEmail, string $newEmail)
    {
        $sql = "UPDATE progetto_utente SET email = '$newEmail' WHERE email = '$oldEmail'";
        $result = $this->db->query($sql);
        return $result->num_rows > 0;
    }

}
