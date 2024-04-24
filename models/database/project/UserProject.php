<?php
require_once ('Project.php');
require_once (__PROJECTROOT__.'/models/database/user/UserInfo.php');
require_once (__PROJECTROOT__.'/models/database/project/ProjectInfo.php');

class UserProject extends Project
{
    protected UserInfo $userInfo;
    protected ProjectInfo $projectInfo;

    protected function __construct(Database $db)
    {
        parent::__construct($db);
        $this->userInfo = new UserInfo($db);
        $this->projectInfo = new ProjectInfo($db);
    }
}