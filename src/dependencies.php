<?php

// DIC configuration

$container = $app->getContainer();

// database
$container['database'] = function ($c) {
    $settings = $c->get('settings')['database'];
    try {
        $dbConnection = new \PDO("mysql:host=" .$settings['host']. ";dbname=" .$settings['name']. ";charset=". $settings['charset'] ."", $settings['user'], $settings['password']);
        $dbConnection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        die($e->getMessage());
    }

    return $dbConnection;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->setTimezone(new \DateTimeZone($settings['timezone']));
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Upload Images
$container['imageDirectory'] = __DIR__ . '/../public/assets/images/users';

// UserController
$container['UserController'] = function () {
    return new UserController();
};

// NotFoundHandler (404)
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $response->withStatus(404)
            ->write('Not Found');
    };
};
