<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$app = new \Slim\App();

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
