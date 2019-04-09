<?php

namespace App\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Repositories\UserRepository;
use App\Services\StorageService;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{
    private $userRepository;
    private $container;
    private $logger;
    private $storage;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->userRepository = new UserRepository($this->container);
        $this->storage = new StorageService;
        $this->logger = $this->container->get('logger');
    }

    public function show(Request $request, Response $response, array $args)
    {
        try {
            $user = $this->userRepository->getUserById($args['id']);
            $this->logger->info('Get User', [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'image' => $user->getImageUrl(),
            ]);

            return $response->withStatus(200)->withJson([
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'image' => $user->getImageUrl(),
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
            $this->userRepository->deleteUserById($args['id']);
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
            $this->userRepository->editUser($request->getParsedBody());
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
        $filename = $this->storage->moveUploadedFile($this->container->get('imageDirectory'), $image);

        if (! $filename) {
            $this->logger->info('ServiceException', ['status' => '503', 'message' => 'Service Unavailable']);

            return $response->withStatus(503)->withJson(['status' => '503', 'message' => 'Service Unavailable']);
        }
        $this->logger->info('Image saved with name: ' . $filename . ' for the user: ' . $id);
        try {
            $this->userRepository->addImage(['id' => $id, 'image' => $filename]);
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
