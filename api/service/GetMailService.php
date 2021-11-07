<?php

namespace service;

class GetMailService
{
    public static function additionalFieldsHandler(
        ?string $additionalFields,
        array $response,
        object $mailModel
    ): array {
        if ($additionalFields === null) {
            return $response;
        }

        $additionalFields = explode(',', $additionalFields);

        foreach ($additionalFields as $additionalField) {
            if ($mailModel->$additionalField !== null) {
                $response[$additionalField] = $mailModel->$additionalField;
            }
        }

        return $response;
    }
}
