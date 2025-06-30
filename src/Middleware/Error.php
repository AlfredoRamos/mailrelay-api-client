<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use AlfredoRamos\Mailrelay\Error\ApiException;

class Error {
    /** @var callable */
    private $nextHandler;

    /**
     * Error middleware constructor.
     *
     * @param callable $nextHandler Next handler to invoke.
     *
     * @return void
     */
    public function __construct(callable $nextHandler) {
        $this->nextHandler = $nextHandler;
    }

    /**
     * Invoke a handler.
     *
     * @param \Psr\Http\Message\RequestInterface $request The HTTP request.
     * @param array $options
     *
     * @return \GuzzleHttp\Promise\PromiseInterface Request promise.
     */
    public function __invoke(RequestInterface $request, array $options) {
        $handler = $this->nextHandler;

        return $handler($request, $options)->then(function (ResponseInterface $response) {
            return $this->checkError($response);
        });
    }

    /**
     * Handle request errors.
     *
     * @return \Closure Function that accepts the next handler.
     */
    public static function error() {
        return function (callable $handler) {
            return new self($handler);
        };
    }

    /**
     * Check request errors
     *
     * @param \Psr\Http\Message\ResponseInterface The HTTP response.
     *
     * @throws \ErrorException      If HTTP request returned an error.
     * @throws \RuntimeException    If HTTP request returned an unknown error.
     * @throws \AlfredoRamos\Mailrelay\Error\ApiException If HTTP request returned multiple errors.
     * @return \Psr\Http\Message\ResponseInterface The HTTP response.
     */
    public function checkError(ResponseInterface $response) {
        if ($response->getStatusCode() < 400) {
            return $response;
        }

        $body = (string) $response->getBody();
        $responseBody = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $responseBody = $body;
        }

        if (is_array($responseBody) && !empty($responseBody['error'])) {
            $message = sprintf(
                '[%d] Mailrelay API request failed: %2$s',
                $response->getStatusCode(),
                $responseBody['error']
            );
            throw new ApiException($message, $response->getStatusCode());
        }


        $exception = new ApiException('API response contains errors', $response->getStatusCode());
        $exception->setErrors($responseBody['errors'] ?? []);

        throw $exception;
    }
}
