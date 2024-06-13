<?php

function isLogged(): bool
{
	global $userDb;
	if (isset($_SESSION['LogIn'])) {
		$data = json_decode($_SESSION['LogIn'], true);
		$logged = $userDb->existsByEmail($data['email']);
		if ($logged) {
			return true;
		}
	}
	return false;
}

function isUserInProject($projectId): bool
{
	global $projectDb;
	global $userDb;
	$data = json_decode($_SESSION['LogIn'], true);
	$userId = $userDb->getId($data['email']);
	$inProject = $projectDb->isUserInProject($userId, $projectId);
	if ($inProject) {
		return true;
	}
	return false;
}
