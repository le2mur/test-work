<?php

namespace controller;

use model\Mails;
use Slim\Http\{Request, Response};

class GetMailList
{
    public function __invoke(Request $request, Response $response): Response
    {
        $page = $request->getQueryParam('page');
        $sortDirection = $request->getQueryParam('order') === 'desc' ? 'desc' : 'asc';

        $mails = Mails::query()
            ->select('name', 'mail')
            ->orderBy('date', $sortDirection)
            ->paginate(10, ['*'], '', $page)
            ->items();

        return $response->withJson($mails, 200, JSON_UNESCAPED_UNICODE);
    }
}
