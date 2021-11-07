<?php

use controller\{CreateMail, GetMail, GetMailList};
use Slim\App;
use Slim\Http\{Request, Response};

return function (App $app) {
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write(file_get_contents('./frontend/dist/index.html'));

        return $response;
    });

    $app->group('/api', function (App $app) {
        $app->post('/createMail', CreateMail::class);
        $app->get('/getMail', GetMail::class);
        $app->get('/getMailList', GetMailList::class);
    });
};
