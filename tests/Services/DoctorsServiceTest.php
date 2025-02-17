<?php

namespace Evg09\DocDoc\Tests\Services;

use Evg09\DocDoc\Exceptions\MaximumCount;
use Evg09\DocDoc\Helpers\Builders\DoctorsQueryBuilder;
use Evg09\DocDoc\Services\DoctorsService;
use Evg09\DocDoc\Services\ServicesService;

class DoctorsServiceTest extends AbstractServiceTest
{
    /**
     * @var array
     */
    protected $doctor;

    /**
     * @var array
     */
    protected $specialities;

    /**
     * @throws \Evg09\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Evg09\DocDoc\Exceptions\MaximumCount
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testAllMaxCount(): void
    {
        $this->expectException(MaximumCount::class);
        $doctors = new DoctorsService($this->client);
        $doctors->all(1, 501);
    }

    /**
     * @throws MaximumCount
     * @throws \Evg09\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testAll(): void
    {
        $doctors = new DoctorsService($this->client);
        $result = $doctors->all(1, 10);
        $this->assertCount(10, $result['DoctorList']);
        foreach ($result['DoctorList'] as $doctor) {
            $this->assertArrayHasKey('Id', $doctor);
        }
    }

    /**
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\RequiredFieldIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testGetDoctors(): void
    {
        $doctors = new DoctorsService($this->client);
        $result = $doctors->getDoctors(
            (new DoctorsQueryBuilder())
                ->setCity(1)
                ->setSpeciality($this->getSpecialitiesList()[0]['Id'])
                ->setStations([1, 2])
                ->setCount(10)
        );
        $this->assertArrayHasKey('Total', $result);
        $this->assertArrayHasKey('DoctorList', $result);
        foreach ($result['DoctorList'] as $doctor) {
            $this->assertArrayHasKey('Id', $doctor);
            $this->assertArrayHasKey('Name', $doctor);
            $this->assertArrayHasKey('Rating', $doctor);
            $this->assertArrayHasKey('Sex', $doctor);
            $this->assertArrayHasKey('Img', $doctor);
            $this->assertArrayHasKey('AddPhoneNumber', $doctor);
            $this->assertArrayHasKey('Category', $doctor);
            $this->assertArrayHasKey('Degree', $doctor);
            $this->assertArrayHasKey('Rank', $doctor);
            $this->assertArrayHasKey('Description', $doctor);
            $this->assertArrayHasKey('ExperienceYear', $doctor);
            $this->assertArrayHasKey('Price', $doctor);
            $this->assertArrayHasKey('SpecialPrice', $doctor);
            $this->assertArrayHasKey('Departure', $doctor);
            $this->assertArrayHasKey('Clinics', $doctor);
            $this->assertArrayHasKey('Alias', $doctor);
            $this->assertArrayHasKey('Specialities', $doctor);
            $this->assertArrayHasKey('Stations', $doctor);
            $this->assertArrayHasKey('BookingClinics', $doctor);
            $this->assertArrayHasKey('isActive', $doctor);
            $this->assertArrayHasKey('TextAbout', $doctor);
            $this->assertArrayHasKey('InternalRating', $doctor);
            $this->assertArrayHasKey('OpinionCount', $doctor);
            $this->assertArrayHasKey('Extra', $doctor);
            $this->assertArrayHasKey('KidsReception', $doctor);
            $this->assertArrayHasKey('ClinicsInfo', $doctor);
        }
    }

    /**
     * @throws MaximumCount
     * @throws \Evg09\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testFind(): void
    {
        $doctors = new DoctorsService($this->client);
        $doctor = $this->getDefaultDoctor();
        $result = $doctors->find($doctor['Id']);
        $this->assertEquals($doctor['Id'], $result['Id']);
    }

    /**
     * @throws MaximumCount
     * @throws \Evg09\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testFindByAlias(): void
    {
        $doctors = new DoctorsService($this->client);
        $doctor = $this->getDefaultDoctor();
        $result = $doctors->findByAlias($doctor['Alias']);
        $this->assertEquals($doctor['Id'], $result['Id']);
    }

    /**
     * @throws MaximumCount
     * @throws \Evg09\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function testGetReview(): void
    {
        $doctors = new DoctorsService($this->client);
        $doctor = $this->getDefaultDoctor();
        $result = $doctors->getReviews($doctor['Id']);
        foreach ($result as $review) {
            $this->assertArrayHasKey('Id', $review);
            $this->assertArrayHasKey('Client', $review);
            $this->assertArrayHasKey('RatingQlf', $review);
            $this->assertArrayHasKey('RatingAtt', $review);
            $this->assertArrayHasKey('RatingRoom', $review);
            $this->assertArrayHasKey('Text', $review);
            $this->assertArrayHasKey('Date', $review);
            $this->assertArrayHasKey('DoctorId', $review);
            $this->assertArrayHasKey('ClinicId', $review);
            $this->assertArrayHasKey('Answer', $review);
            $this->assertArrayHasKey('WaitingTime', $review);
            $this->assertArrayHasKey('RatingDoctor', $review);
            $this->assertArrayHasKey('RatingClinic', $review);
            $this->assertArrayHasKey('TagClinicLocation', $review);
            $this->assertArrayHasKey('TagClinicService', $review);
            $this->assertArrayHasKey('TagClinicCost', $review);
            $this->assertArrayHasKey('TagClinicRecommend', $review);
            $this->assertArrayHasKey('TagDoctorAttention', $review);
            $this->assertArrayHasKey('TagDoctorExplain', $review);
            $this->assertArrayHasKey('TagDoctorQuality', $review);
            $this->assertArrayHasKey('TagDoctorRecommend', $review);
        }
    }

    /**
     * @return array
     * @throws MaximumCount
     * @throws \Evg09\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    protected function getDefaultDoctor(): array
    {
        if ($this->doctor === null) {
            $doctors = new DoctorsService($this->client);
            $this->doctor = $doctors->all(1, 1)['DoctorList'][0];
        }
        return $this->doctor;
    }

    /**
     * @return array
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    protected function getSpecialitiesList(): array
    {
        if ($this->specialities === null) {
            $services = new ServicesService($this->client);
            $this->specialities = $services->getSpecialities(1);
        }
        return $this->specialities;
    }
}
