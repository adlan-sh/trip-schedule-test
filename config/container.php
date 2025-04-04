<?php

declare(strict_types=1);

use League\Plates\Engine;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return [
    'config' => require 'config.php',
    PDO::class => function(ContainerInterface $c) {
        try {
            return new PDO($c->get('config')['database']['pdo_dsn']);
        } catch (PDOException $e) {
            if (false !== strpos($e->getMessage(), 'could not find driver')) {
                $driver = $c->get('config')['database']['pdo_dsn'];
                $driver = substr($driver, 0, strpos($driver, ':'));
                printf("PDO error: you need to install the %s extension for PHP", $driver);
                exit(1);
            }
            printf("PDO Error: %s", $e->getMessage());
            exit(1);
        }
    },
    Engine::class => function(ContainerInterface $c) {
        $config = $c->get('config')['view'];
        $engine = new Engine($config['path']);
        foreach ($config['folders'] as $name => $folder) {
            $engine->addFolder($name, $folder);
        }
        return $engine;
    },
    LoggerInterface::class => function(ContainerInterface $c) {
        $config = $c->get('config')['logger'];
        $logger = new Logger($config['name']);
        $handler = new StreamHandler($config['path'], $config['level']);
        $handler->setFormatter((new LineFormatter())->ignoreEmptyContextAndExtra());
        return $logger->pushHandler($handler);
    },
];
