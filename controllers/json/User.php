<?php

include_once 'JsonApi.php';
include_once __PROJECTROOT__ . '/models/database/user/NewUser.php';

$registerUser = (new JsonApiBuilder())
	->setPath('/user/register')
	->setMethod('POST')
	->setInputParams(['email', 'username', 'password'])
	->setLogicClass('NewUser')
	->setLogicMethod('createUser')
	->setErrorHandler(function ($message) {
		http_response_code(400);
		echo json_encode(['error' => $message]);
	})
	->createApi();

$loginUser = (new JsonApiBuilder())
	->setPath('/user/login')
	->setMethod('POST')
	->setInputParams(['email', 'password'])
	->setLogicClass('UserInfo')
	->setLogicMethod('exists')
	->setErrorHandler(function ($message) {
		http_response_code(400);
		echo json_encode(['error' => $message]);
	})
	->createApi();
