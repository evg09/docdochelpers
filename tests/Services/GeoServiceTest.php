<?php

namespace Evg09\DocDoc\Tests\Services;

use Evg09\DocDoc\Services\GeoService;

class GeoServiceTest extends AbstractServiceTest
{
    /**
     * @var array
     */
    protected $cities;

    /**
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testGetCities(): void
    {
        $locations = new GeoService($this->client);
        $result = $locations->getCities();
        $this->assertIsArray($result);
        $this->assertTrue(\count($result) > 0);
        foreach ($result as $city) {
            $this->assertArrayHasKey('Id', $city);
            $this->assertArrayHasKey('Name', $city);
            $this->assertArrayHasKey('Alias', $city);
            $this->assertArrayHasKey('Phone', $city);
            $this->assertArrayHasKey('Latitude', $city);
            $this->assertArrayHasKey('Longitude', $city);
            $this->assertArrayHasKey('SearchType', $city);
            $this->assertArrayHasKey('HasDiagnostic', $city);
            $this->assertArrayHasKey('TimeZone', $city);
        }
    }

    /**
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testGetStreets(): void
    {
        $locations = new GeoService($this->client);
        $cities = $this->getCities();
        $result = $locations->getStreets($cities[0]['Id']);
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey('Id', $result[0]);
        $this->assertArrayHasKey('CityId', $result[0]);
        $this->assertArrayHasKey('Title', $result[0]);
        $this->assertArrayHasKey('RewriteName', $result[0]);
    }

    /**
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testGetDistricts(): void
    {
        $locations = new GeoService($this->client);
        $cities = $this->getCities();
        $result = $locations->getDistricts($cities[0]['Id']);
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey('Id', $result[0]);
        $this->assertArrayHasKey('Alias', $result[0]);
        $this->assertArrayHasKey('Name', $result[0]);
        $this->assertArrayHasKey('Area', $result[0]);
    }

    /**
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testNearDistricts(): void
    {
        $locations = new GeoService($this->client);
        $cities = $this->getCities();
        $district = $locations->getDistricts($cities[0]['Id']);
        $result = $locations->nearDistricts($district[0]['Id']);
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey('Id', $result[0]);
        $this->assertArrayHasKey('Alias', $result[0]);
        $this->assertArrayHasKey('Name', $result[0]);
        $this->assertArrayHasKey('Area', $result[0]);
    }

    /**
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testDetectCity(): void
    {
        $locations = new GeoService($this->client);
        $cities = $this->getCities();
        $result = $locations->detectCity($cities[0]['Latitude'], $cities[0]['Longitude']);
        $this->assertEquals($result['Id'], (int)$cities[0]['Id']);
    }

    /**
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testGetMoscowArea(): void
    {
        $locations = new GeoService($this->client);
        $result = $locations->getMoscowArea();
        $this->assertTrue(\count($result) > 0);
        foreach ($result as $area) {
            $this->assertArrayHasKey('Id', $area);
            $this->assertArrayHasKey('Alias', $area);
            $this->assertArrayHasKey('Name', $area);
            $this->assertArrayHasKey('FullName', $area);
        }
    }

    /**
     * @return array
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    protected function getCities(): array
    {
        if ($this->cities === null) {
            $locations = new GeoService($this->client);
            $this->cities = $locations->getCities();
        }
        return $this->cities;
    }
}
