<?php

include_once 'JsonApi.php';
include_once __PROJECTROOT__ . '/models/database/user/NewUser.php';
include_once __PROJECTROOT__ . '/models/database/user/ModifyUser.php';
include_once __PROJECTROOT__ . '/api/config/db_config.php';

$registerUser = (new JsonApiBuilder())
	->setPath('/user/register')
	->setInputParams(['email', 'username', 'password'])
	->setLogicFn(
		function ($params) {
			try {
				$newUser = new NewUser(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				$newUser->createUser($params['email'], $params['username'], $params['password']);
			} catch (Exception $_) {
				header('Content-Type: application/json');
				echo json_encode(['error' => "User already exists"]);
			}
		}
	)
	->createApi();

$loginUser = (new JsonApiBuilder())
	->setPath('/user/login')
	->setInputParams(['email', 'password'])
	->setLogicFn(
		function ($params) {
			try {
				$user = new UserInfo(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				if (!$user->checkCredentials($params['email'], $params['password'])) {
					throw new Exception("Invalid credentials");
				} else {
					setCookieUser($params['email'], $params['username'], $params['password']);
				}
			} catch (Exception $_) {
				header('Content-Type: application/json');
				echo json_encode(['error' => "Invalid credentials"]);
			}
		}
	)
	->createApi();

$modifyUser = (new JsonApiBuilder())
	->setPath('/user/modify')
	->setInputParams(['newEmail', 'newUsername', 'newPassword'])
	->setLogicFn(
		function ($params) {
			try {
				$user = new ModifyUser(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				$email = json_decode($_SESSION["LogIn"], true)["email"];
				$password = json_decode($_SESSION["LogIn"], true)["password"];
				$user->modify($email, $password, $params['newEmail'], $params['newUsername'], $params['newPassword']);
				setCookieUser($params['newEmail'], $params['newUsername'], $params['newPassword']);
				header("Location: /accout_home");
			} catch (Exception $_) {
				header('Content-Type: application/json');
				echo json_encode(['error' => "Invalid credentials"]);
			}
		}
	)
	->createApi();
