<?php

use Illuminate\Database\Capsule\Manager;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();
    
    $capsule = new Manager();
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    
    $container['db'] = function () use ($capsule) {
        return $capsule;
    };
};
