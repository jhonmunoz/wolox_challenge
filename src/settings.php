<?php
return [
    'settings' => [
        // Slim Settings
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        // database
        'database' => [
            'host' => '127.0.0.1',
            'name' => 'wolox_challenge',
            'charset' => 'UTF8',
            'user' => 'root',
            'password' => '',
           ],
        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' =>  __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
            'timezone' => 'America/Argentina/Buenos_Aires'
        ],
    ],
];
