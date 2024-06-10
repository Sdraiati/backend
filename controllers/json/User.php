<?php

include_once 'JsonApi.php';
include_once __PROJECTROOT__ . '/controllers/Router.php';
include_once __PROJECTROOT__ . '/models/database/user/NewUser.php';
include_once __PROJECTROOT__ . '/models/database/user/ModifyUser.php';
include_once __PROJECTROOT__ . '/api/config/db_config.php';

$registerUser = (new JsonApiBuilder())
	->setPath('user/register')
	->setInputParams(['email', 'username', 'password'])
	->setLogicFn(
		function ($params) {
			try {
				$newUser = new NewUser(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				$newUser->createUser($params['email'], $params['username'], $params['password']);
				return ['message' => "User created"];
			} catch (Exception $_) {
				return ['error' => "User already exists"];
			}
		}
	)
	->createApi();

$loginUser = (new JsonApiBuilder())
	->setPath('user/login')
	->setInputParams(['email', 'password'])
	->setLogicFn(
		function ($params) {
			try {
				$user = new UserInfo(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				if (!$user->checkCredentials($params[0], $params[1])) {
					throw new Exception("Invalid credentials");
				} else {
					$user = $user->getUser($params[0]);
					setCookieUser($user['email'], $user['username'], $user['password']);
					return ['message' => "User logged in"];
				}
			} catch (Exception $_) {
				return ['error' => "Invalid credentials"];
			}
		}
	)
	->createApi();

$modifyUser = (new JsonApiBuilder())
	->setPath('user/modify')
	->setInputParams(['newEmail', 'newUsername', 'newPassword'])
	->setLogicFn(
		function ($params) {
			try {
				$user = new ModifyUser(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				$email = json_decode($_SESSION["LogIn"], true)["email"];
				$password = json_decode($_SESSION["LogIn"], true)["password"];
				$user->modify($email, $password, $params[0], $params[1], $params[2]);
				setCookieUser($params[0], $params[1], $params[2]);
				return ['message' => "User modified"];
			} catch (Exception $_) {
				return ['error' => "Invalid credentials"];
			}
		}
	)
	->createApi();

$user_router = new Router();
$user_router->addRoute($registerUser);
$user_router->addRoute($loginUser);
$user_router->addRoute($modifyUser);
