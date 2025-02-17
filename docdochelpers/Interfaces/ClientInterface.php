<?php

namespace Evg09\DocDoc\Interfaces;

use Evg09\DocDoc\Exceptions\MethodIsNotSet;
use Evg09\DocDoc\Exceptions\Unauthorized;
use Evg09\DocDoc\Helpers\Headers;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ClientInterface
 * @package Evg09\DocDoc\Interfaces
 */
interface ClientInterface
{
    /**
     * @param string $method
     * @return ClientInterface
     */
    public function setMethod(string $method): ClientInterface;

    /**
     * @param Headers|null $headers
     * @throws MethodIsNotSet
     * @throws Unauthorized
     * @return ResponseInterface
     */
    public function get(Headers $headers = null): ResponseInterface;

    /**
     * @param Headers|null $headers
     * @param string|null $body
     * @throws MethodIsNotSet
     * @throws Unauthorized
     * @return ResponseInterface
     */
    public function post(Headers $headers = null, ?string $body = ''): ResponseInterface;

    /**
     * @return array
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getJson(): array;
}
