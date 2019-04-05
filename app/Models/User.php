<?php

namespace App\Models;

use App\Services\DatabaseService as DB;
use App\Exceptions\UserNotFoundException;

class User
{
	private $db;

	public function __construct()
	{
		$this->db = DB::getInstance();
	}

	public function getUser(int $id): array
	{
		$query = "SELECT *
			  	  FROM wolox_challenge.user U
			      WHERE U.id = {$id} LIMIT 1";
		$result = $this->db->query($query);

		if (! $result->rowCount()) {
			throw new UserNotFoundException();
		}

		return $result->fetch();
	}

	public function deleteUser(int $id)
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
}