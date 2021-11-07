<?php

namespace test;

use PHPUnit\Framework\TestCase;
use service\GetMailService;
use stdClass;

class GetMailServiceTest extends TestCase
{
    private $defaultResponseArray = [
      'name' => 'name',
      'mail' => 'mail',
      'text' => 'text'
    ];
    
    private $responseArrayWithFields = [
        'name' => 'name',
        'mail' => 'mail',
        'text' => 'text',
        'description' => 'description',
        'photo_links' => 'photo_links'
    ];

    private object $mailModel;

    protected function setUp(): void
    {
        $this->mailModel = new stdClass();

        $this->mailModel->name = 'name';
        $this->mailModel->mail = 'mail';
        $this->mailModel->text = 'text';
        $this->mailModel->description = 'description';
        $this->mailModel->photo_links = 'photo_links';
    }

    public function testEmptyAdditionalFields(): void
    {
        $actualResponseArray = GetMailService::additionalFieldsHandler(
            null,
            $this->defaultResponseArray,
            $this->mailModel
        );

        static::assertEquals($this->defaultResponseArray, $actualResponseArray);
    }
    
    public function testNonEmptyAdditionalFields(): void
    {
        $actualResponseArray = GetMailService::additionalFieldsHandler(
            'description,photo_links',
            $this->defaultResponseArray,
            $this->mailModel
        );

        static::assertEquals($this->responseArrayWithFields, $actualResponseArray);
    }
}
