<?php

namespace controller;

use model\Mails;
use Slim\Http\{Request, Response};
use service\GetMailService;

class GetMail
{
    public function __invoke(Request $request, Response $response): Response
    {
        $mailId = $request->getQueryParam('id');
        $additionalFields = $request->getQueryParam('fields');

        $mail = Mails::query()->find($mailId);
        $result = [];

        if ($mail !== null) {
            $result['name'] = $mail->name;
            $result['mail'] = $mail->mail;
            $result['text'] = $mail->text;

            $result = GetMailService::additionalFieldsHandler($additionalFields, $result, $mail);
        }

        return $response->withJson($result, 200, JSON_UNESCAPED_UNICODE);
    }
}
