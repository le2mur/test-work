<?php

use Slim\App;

require_once __DIR__ . '/vendor/autoload.php';

$settings = require __DIR__ . '/api/settings.php';
$app = new App($settings);

$dependencies = require __DIR__ . '/api/dependencies.php';
$dependencies($app);

$routes = require __DIR__ . '/api/routes.php';
$routes($app);

try {
    $app->run();
} catch (Throwable $exception) {
    echo $exception->getMessage();
}

