<?php

declare(strict_types=1);

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use DI\ContainerBuilder;
use SimpleMVC\App;
use SimpleMVC\Emitter\SapiEmitter;

$builder = new ContainerBuilder();
$builder->addDefinitions('config/container.php');

$app = new App($builder->build());
$app->bootstrap();
$request = App::buildRequestFromGlobals();
$response = $app->dispatch($request);
SapiEmitter::emit($response);