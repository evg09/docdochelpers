<?php


namespace Evg09\DocDoc\Interfaces\Helpers;

use Evg09\DocDoc\Exceptions\RequiredFieldIsNotSet;

/**
 * Interface QueryBuilderInterface
 * @package Evg09\DocDoc\Interfaces\Helpers
 */
interface QueryBuilderInterface
{
    /**
     * @return string
     * @throws RequiredFieldIsNotSet
     */
    public function getQueryString(): string;
}
