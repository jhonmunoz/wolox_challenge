<?php

namespace App\Repositories;

use App\Entities\User;
use App\Exceptions\UserNotFoundException;
use Slim\Container;

class UserRepository
{
    private $db;

    public function __construct(Container $container)
    {
        $this->db = $container->get('database');
    }

    public function getUserById(int $id): User
    {
        $query = "SELECT *
                   FROM wolox_challenge.user U
                  WHERE U.id = {$id} LIMIT 1";
        $result = $this->db->query($query);

        if (! $result->rowCount()) {
            throw new UserNotFoundException();
        }
        
        return new User($result->fetch());
    }

    public function deleteUserById(int $id)
    {
        $query = "DELETE FROM wolox_challenge.user
                  WHERE id = :id";
        $result = $this->db->prepare($query);
        $result->bindParam(':id', $id);
        if (! $result->execute()) {
            throw new Exception();
        }
    }

    public function editUser(array $params)
    {
        $query = "UPDATE wolox_challenge.user
                  SET name = :name, email = :email, image = :image
                  WHERE id = {$params['id']}";

        $result = $this->db->prepare($query);
        $result->bindParam(':name', $params['name']);
        $result->bindParam(':email', $params['email']);
        $result->bindParam(':image', $params['image']);
        if (! $result->execute()) {
            throw new Exception();
        }
    }

    public function addImage(array $params)
    {
        $query = "UPDATE wolox_challenge.user
                  SET image = :image
                  WHERE id = {$params['id']}";

        $result = $this->db->prepare($query);
        $result->bindParam(':image', $params['image']);
        if (! $result->execute()) {
            throw new Exception();
        }
    }
}
