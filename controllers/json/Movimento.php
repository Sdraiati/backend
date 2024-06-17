<?php

include_once 'JsonApi.php';

include_once __PROJECTROOT__ . '/controllers/Router.php';
include_once 'lib.php';

$newMovimento = (new JsonApiBuilder())
	->setPath('movimento/new')
	->setInputParams(['project_id', 'newData', 'newImporto', 'newDescrizione', 'newTag'])
	->setLogicFn(
		function ($params) {
            try {
                $project_id = $params[0];
                if (!isLogged() || !isUserInProject($project_id)) {
                    http_response_code(401);
                    echo json_encode(['error' => "Unauthorized"]);
                    return;
                }
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['error' => $e->getMessage()]);
            }
            global $movimentoDb;
            global $tagDb;
            if($params[4] != "")
                $tag_id = $tagDb->getIdByName($project_id, $params[4]);
            else
                $tag_id = null;
            try {
                $movimentoDb->new($project_id, $params[1], $params[2], $params[3], $tag_id);
                http_response_code(200);
                echo json_encode(['message' => "Movimento added"]);
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(['error' => $e->getMessage()]);
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

$mov_router = new Router();
$mov_router->addRoute($newMovimento);