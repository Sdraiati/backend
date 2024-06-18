<?php

include_once 'JsonApi.php';

include_once __PROJECTROOT__ . '/controllers/Router.php';
include_once __PROJECTROOT__ . '/models/database/user/NewUser.php';
include_once __PROJECTROOT__ . '/models/database/user/ModifyUser.php';
include_once __PROJECTROOT__ . '/api/config/db_config.php';
include_once 'lib.php';

$registerUser = (new JsonApiBuilder())
	->setPath('user/register')
	->setInputParams(['email', 'username', 'password'])
	->setLogicFn(
		function ($params) {
			try {
				$newUser = new NewUser(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				$newUser->createUser($params[0], $params[1], $params[2]);

				http_response_code(200);
				echo json_encode(['message' => "User created"]);
			} catch (Exception $_) {
				http_response_code(400);
				echo json_encode(['error' => "User already exists"]);
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
					throw new Exception("Formato delle credenziali non corretto!");
				} else {
					$user = $user->getUser($params[0]);
					setCookieUser($user['email'], $user['username'], $user['password']);

					http_response_code(200);
					echo json_encode(['message' => "User logged in", "redirect" => "account_home"]);
				}
			} catch (Exception $_) {
				http_response_code(400);
				echo json_encode(['error' => "Invalid credentials"]);
			}
		}
	)
	->createApi();

$modifyUser = (new JsonApiBuilder())
	->setPath('user/modify')
	->setInputParams(['newEmail', 'newUsername', 'newPassword', 'oldPassword'])
	->setLogicFn(
		function ($params) {
			if (!isLogged() || !checkPassword($params[3])) {
				http_response_code(401);
				echo json_encode(['error' => "Unauthorized"]);
				return;
			}
			try {
				$modUser = new ModifyUser(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				$email = json_decode($_SESSION["LogIn"], true)["email"];
				$password = json_decode($_SESSION["LogIn"], true)["password"];
				$modUser->modify($email, $password, ['email' => $params[0], 'username' => $params[1], 'password' => $params[2]]);
				$userInfo = new UserInfo(Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD));
				if ($params[0] != "") {
					$email = $params[0];
				}
				$user = $userInfo->getUser($email);
				setCookieUser($user['email'], $user['username'], $user['password']);

				http_response_code(200);
				echo json_encode(['message' => "User modified", "redirect" => "account_home"]);
			} catch (Exception $_) {

				http_response_code(400);
				echo json_encode(['error' => "Invalid credentials"]);
			}
		}
	)
	->createApi();

$user_router = new Router();
$user_router->addRoute($registerUser);
$user_router->addRoute($loginUser);
$user_router->addRoute($modifyUser);
