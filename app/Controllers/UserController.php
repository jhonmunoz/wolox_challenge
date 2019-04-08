<?php

namespace App\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{
	private $user;
	private $logger;

	public function __construct()
	{
		$this->user = new User;
		$this->logger = new Logger('log');
		$this->logger->setTimezone(new \DateTimeZone('America/Argentina/Buenos_Aires'));
		$this->logger->pushHandler(new StreamHandler(__DIR__.'/../../logs/app.log', Logger::DEBUG));
	}

	public function show(Request $request, Response $response, array $args)
	{
		try {
			$user = $this->user->getUser($args['id']);
			$this->logger->info('Get User', [				
				'id' => $user['id'],
				'name' => $user['name'],
				'email' => $user['email'],
				'image' => $user['image'],
			]);
			
			return $response->withStatus(200)->withJson([
				'id' => $user['id'],
				'name' => $user['name'],
				'email' => $user['email'],
				'image' => $user['image'],
			]);
		} catch (UserNotFoundException $e) {
			$this->logger->info('UserNotFoundException', ['status' => '404', 'message' => 'Not Found']);

			return $response->withStatus(404)->withJson(['status' => '404', 'message' => 'Not Found']);	
		} catch (PDOException $e) {
			$this->logger->info('PDOException', ['status' => '500', 'message' => 'There was an error while processing your request']);

			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'There was an error while processing your request']);
		}

	}

	public function delete(Request $request, Response $response, array $args)
	{
		try {
			$this->user->deleteUser($args['id']);
			$this->logger->info('User Deleted', ['status' => '204', 'message' => 'No Content']);

			return $response->withStatus(204)->withJson(['status' => '204', 'message' => 'No Content']);
		} catch (Exception $e) {
			$this->logger->info('Exception', ['status' => '500', 'message' => 'Internal Server Error']);

			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'Internal Server Error']);
		} catch (PDOException $e) {
			$this->logger->info('PDOException', ['status' => '500', 'message' => 'There was an error while processing your request']);

			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'There was an error while processing your request']);
		}
	}

	public function edit(Request $request, Response $response, array $args)
	{
		try {
			$this->user->editUser($request->getParsedBody());
			$this->logger->info('User Updated', ['status' => '204', 'message' => 'No Content']);

			return $response->withStatus(204)->withJson(['status' => '204', 'message' => 'No Content']);
		} catch (Exception $e) {
			$this->logger->info('Exception', ['status' => '500', 'message' => 'Internal Server Error']);

			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'Internal Server Error']);
		} catch (PDOException $e) {
			$this->logger->info('PDOException', ['status' => '500', 'message' => 'There was an error while processing your request']);

			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'There was an error while processing your request']);
		}
	}

	public function add(Request $request, Response $response, array $args)
	{
		$image = $request->getUploadedFiles()['image'];
		$id = $request->getParsedBody()['id'];
		$path = __DIR__ . '/../../public/images/users/' . $id;

		if (! is_dir($path)) {
			mkdir($path, 0777, true);
			$this->logger->info('Directory created with path '. $path);			
		}
		$path = $path . '/' . $image->getClientFilename();
		if (! file_exists($path)) {
			$image->moveTo($path);
			$this->logger->info('Image moved at '. $path);
		}
		try {
			$this->user->addImage(['id' => $id, 'image' => $path]);
			$this->logger->info('Image Updated', ['status' => '204', 'message' => 'No Content']);

			return $response->withStatus(204)->withJson(['status' => '204', 'message' => 'No Content']);
		} catch (Exception $e) {
			$this->logger->info('Exception', ['status' => '500', 'message' => 'Internal Server Error']);

			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'Internal Server Error']);
		} catch (PDOException $e) {
			$this->logger->info('PDOException', ['status' => '500', 'message' => 'There was an error while processing your request']);

			return $response->withStatus(500)->withJson(['status' => '500', 'message' => 'There was an error while processing your request']);
		}
	}
}