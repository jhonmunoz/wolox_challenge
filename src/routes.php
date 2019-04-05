<?php

use App\Controllers\UserController;

// Routes
$app->get('/users/{id}', UserController::class . ":show");
$app->delete('/users/{id}', UserController::class . ":delete");
$app->patch('/users/edit', UserController::class . ":edit");
$app->post('/users/add', UserController::class . ":add");

$app->run();
