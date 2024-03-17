<?php


namespace Evg09\DocDoc\Interfaces\Services;

/**
 * Interface IllnessServiceInterface
 * @package Evg09\DocDoc\Interfaces\Services
 */
interface IllnessServiceInterface
{
    /**
     * Detailed disease information
     *
     * @inheritDoc
     * @return array
     */
    public function info(int $id): array;
}
