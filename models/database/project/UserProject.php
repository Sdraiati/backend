<?php
define('__PROJECTROOT__', dirname(__FILE__, 4));
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
        if (!$this->userInfo->exists($userId))
            die("isUserInProject: user not found with id $userId");
        // check if project exists
        if (!$this->projectInfo->exists($projectId))
            die("isUserInProject: project not found with id $projectId");

        $sql = "SELECT * FROM progetto_utente WHERE id_progetto = ? AND email = ?";
        $params = [
            ['type' => 'i', 'value' => $projectId],
            ['type' => 's', 'value' => $userId]
        ];
        $stmt = $this->db->prepareAndBindParams($sql, $params);
        $stmt->execute() or die($stmt->error);

        return $stmt->get_result()->num_rows > 0;
    }
}