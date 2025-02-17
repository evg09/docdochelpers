<?php

namespace Evg09\DocDoc\Tests\Services;

use Evg09\DocDoc\Exceptions\MethodIsNotSet;
use Evg09\DocDoc\Exceptions\ResponseError;
use Evg09\DocDoc\Exceptions\Unauthorized;
use Evg09\DocDoc\Services\ServicesService;
use function count;

class ServicesServiceTest extends AbstractServiceTest
{
    /**
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetDiagnostics(): void
    {
        $services = new ServicesService($this->client);
        $diagnostics = $services->getDiagnostics();
        $this->assertTrue(count($diagnostics) > 0);
        foreach ($diagnostics as $diagnostic) {
            $this->assertArrayHasKey('Name', $diagnostic);
            $this->assertArrayHasKey('Alias', $diagnostic);
            $this->assertArrayHasKey('SubDiagnosticList', $diagnostic);
        }
    }

    /**
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetSpecialities(): void
    {
        $services = new ServicesService($this->client);
        $result = $services->getSpecialities(1);
        $this->assertTrue(count($result) > 0);
    }

    /**
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetServices(): void
    {
        $services = new ServicesService($this->client);
        $result = $services->getServices();
        $this->assertTrue(count($result) > 0);
        foreach ($result as $service) {
            $this->assertArrayHasKey('Id', $service);
            $this->assertArrayHasKey('Name', $service);
            $this->assertArrayHasKey('Lft', $service);
            $this->assertArrayHasKey('Rgt', $service);
            $this->assertArrayHasKey('Depth', $service);
            $this->assertArrayHasKey('SectorId', $service);
            $this->assertArrayHasKey('DiagnosticaId', $service);
        }
    }
}
