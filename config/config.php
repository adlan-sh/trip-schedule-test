<?php

declare(strict_types=1);

use App\Config\Route;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

return [
    'routing' => [
        'routes' => Route::getRoutes(),
        'cache' => 'data/cache/route.cache'
    ],
    'database' => [
        'pdo_dsn' => 'pgsql:host=db;port=5432;dbname=schedule_db;user=user;password=password',
    ],
    'view' => [
        'path' => 'src/View',
        'folders' => [
            'admin' => 'src/View/admin'
        ],
    ],
    'logger' => [
        'name' => 'app',
        'path' => sprintf("data/log/%s.log", date("Y_m_d")),
        'level' => Logger::DEBUG,
    ],
    'authentication' => [
        'username' => 'test',
        'password' => '1234567890'
    ],
    'bootstrap' => function(ContainerInterface $c) {
       session_start();
    }
];