<?php


namespace Evg09\DocDoc\Services;

use Evg09\DocDoc\Interfaces\Services\IllnessServiceInterface;

/**
 * Class IllnessService
 * @package Evg09\DocDoc\Services
 */
class IllnessService extends AbstractService implements IllnessServiceInterface
{
    /**
     * @param int $id
     * @return array
     * @throws \Evg09\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Evg09\DocDoc\Exceptions\ResponseError
     * @throws \Evg09\DocDoc\Exceptions\Unauthorized
     */
    public function info(int $id): array
    {
        return $this->get("illness/{$id}", 'Id');
    }
}
