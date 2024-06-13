<?php

include_once 'JsonApi.php';

include_once __PROJECTROOT__ . '/controllers/Router.php';
include_once __PROJECTROOT__ . '/models/database/movimento/Movimento.php';
include_once __PROJECTROOT__ . '/models/database/project/UserProject.php';
include_once __PROJECTROOT__ . '/models/database/user/UserInfo.php';
include_once 'lib.php';

$database = Database::getInstance(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
$movimentoDb = new Movimento($database);
$projectDb = new UserProject($database);
$userDb = new UserInfo($database);

$newMovimento = (new JsonApiBuilder())
	->setPath('movimento/new')
	->setInputParams(['id_progetto', 'newData', 'newImporto', 'newDescrizione', 'newTag'])
	->setLogicFn(
		function ($params) {
			if (!isLogged() || !isUserInProject($params[0])) {
				http_response_code(401);
				echo json_encode(['error' => "Unauthorized"]);
				return;
			}
			global $movimentoDb;
			try {
				$movimentoDb->new($params[0], $params[1], $params[2], $params[3], $params[4]);
				http_response_code(200);
				echo json_encode(['message' => "Movimento added"]);
			} catch (Exception $_) {
				http_response_code(400);
				echo json_encode(['error' => "Error adding movimento"]);
			}
		}
	)
	->createApi();

$modifyMovimento = (new JsonApiBuilder())
	->setPath('movimento/modify')
	->setInputParams(['id_progetto', 'id_transazione', 'editData', 'editImporto', 'editDescrizione', 'editTag'])
	->setLogicFn(
		function ($params) {
			if (!isLogged() || !isUserInProject($params[0])) {
				http_response_code(401);
				echo json_encode(['error' => "Unauthorized"]);
				return;
			}
			global $movimentoDb;
			try {
				$movimentoDb->update(
					$params[0],
					[
						'data' => $params[2],
						'importo' => $params[3],
						'descrizione' => $params[4],
						'tag_id' => $params[5]
					]
				);

				http_response_code(200);
				echo json_encode(['message' => "Movimento edited"]);
			} catch (Exception $_) {
				http_response_code(400);
				echo json_encode(['error' => "Error editing movimento"]);
			}
		}
	)
	->createApi();

$deleteMovimento = (new JsonApiBuilder())
	->setPath('movimento/delete')
	->setInputParams(['id_progetto', 'id_transazione'])
	->setLogicFn(
		function ($params) {
			if (!isLogged() || !isUserInProject($params[0])) {
				http_response_code(401);
				echo json_encode(['error' => "Unauthorized"]);
				return;
			}
			global $movimentoDb;
			try {
				$movimentoDb->delete($params[1]);

				http_response_code(200);
				echo json_encode(['message' => "Movimento deleted"]);
			} catch (Exception $_) {
				http_response_code(400);
				echo json_encode(['error' => "Error deleting movimento"]);
			}
		}
	)
	->createApi();

$user_router = new Router();
