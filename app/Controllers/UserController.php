<?php

namespace App\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{
	private $user;

	public function __construct()
	{
		$this->user = new User;
	}

	public function show(Request $request, Response $response, array $args)
	{
		try {
			$user = $this->user->getUser($args['id']);

			return $response->withStatus(200)->withJson([
				'id' => $user['id'],
				'name' => $user['name'],
				'email' => $user['email'],
				'image' => $user['image'],
			]);
		} catch (UserNotFoundException $e) {
			return $response->withStatus(404)->withJson(['status' => '404', 'message' => 'Not Found']);	
		} catch (PDOException $e) {
			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'There was an error while processing your request']);
		}

	}

	public function delete(Request $request, Response $response, array $args)
	{
		try {
			$this->user->deleteUser($args['id']);

			return $response->withStatus(204)->withJson(['status' => '204', 'message' => 'No Content']);
		} catch (Exception $e) {
			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'Internal Server Error']);
		} catch (PDOException $e) {
			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'There was an error while processing your request']);
		}
	}

	public function edit(Request $request, Response $response, array $args)
	{
		try {
			$this->user->editUser($request->getParsedBody());

			return $response->withStatus(204)->withJson(['status' => '204', 'message' => 'No Content']);
		} catch (Exception $e) {
			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'Internal Server Error']);
		} catch (PDOException $e) {
			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'There was an error while processing your request']);
		}
	}

	// Add image for the selected user (sending his id)
	public function add(Request $request, Response $response, array $args)
	{
		$image = $request->getUploadedFiles()['image'];
		// if (! is_dir('../../public/assets/images/users/' . $request->getParsedBody()['id'] . '/')) {
		// 	var_dump('entre');
		// 	mkdir('../../public/assets/images/users/' . $request->getParsedBody()['id'] . '/', 0777, true);
		// }
		// die('1');
	}
}