<?php

namespace App\Services;


class DatabaseService
{
	protected static $instance;

	public static function getInstance()
	{
		if (self::$instance) {

			return self::$instance;
		}
		try {
			self::$instance = new \PDO( "mysql:host=127.0.0.1;dbname=wolox_challenge;charset=UTF8", 'root', '');
			self::$instance->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			die($e->getMessage());
		}

		return self::$instance;
	}
}