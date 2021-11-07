<?php

namespace controller;

use model\Mails;
use Slim\Http\{Request, Response};
use Throwable;

class CreateMail
{
    public function __invoke(Request $request, Response $response): Response
    {
        $parsedBody = $request->getParsedBody();

        try {
            $mail = new Mails();

            $mail->name = $parsedBody['name'];
            $mail->mail = $parsedBody['mail'];
            $mail->text = $parsedBody['text'];

            $mail->save();

            return $response->withJson([
                'id' => $mail->id,
                'statusCode' => 200
            ], 200);
        } catch (Throwable $throwable) {
            return $response->withJson([
                'message' => $throwable->getMessage(),
                'statusCode' => 500
            ], 500);
        }
    }
}
