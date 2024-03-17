<?php

namespace Evg09\DocDoc\Tests\Services;

use Evg09\DocDoc\Exceptions\MethodIsNotSet;
use Evg09\DocDoc\Exceptions\ResponseError;
use Evg09\DocDoc\Exceptions\Unauthorized;
use Evg09\DocDoc\Services\ServicesService;

class AutocompleteTest extends AbstractServiceTest
{
    /**
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testAutocomplete(): void
    {
        $autocomplete = new ServicesService($this->client);
        $result = $autocomplete->autocomplete(1, 'Аллерг');
        $this->assertArrayHasKey('Value', $result[0]);
        $this->assertArrayHasKey('Type', $result[0]);
        $this->assertArrayHasKey('Id', $result[0]);
        $this->assertArrayHasKey('Url', $result[0]);
    }
}
