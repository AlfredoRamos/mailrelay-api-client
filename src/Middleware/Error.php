<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Middleware;

use PHPUnit\Runner\Version;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Promise\PromiseInterface;

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
	public function __invoke(RequestInterface $request, array $options): PromiseInterface {
		$handler = $this->nextHandler;

		return $handler($request, $options)->then(function (ResponseInterface $response) {
			return $this->checkError($response);
		});
	}

	/**
	 * Handle request errors.
	 *
	 * @return callable Function that accepts the next handler.
	 */
	public static function error(): callable {
		return function (callable $handler) {
			return new self($handler);
		};
	}

	/**
	 * Check request errors
	 *
	 * @param \Psr\Http\Message\ResponseInterface The HTTP response.
	 *
	 * @throws \ErrorException		If HTTP request returned an error.
	 * @throws \RuntimeException	If HTTP request returned an unknown error.
	 *
	 * @return \Psr\Http\Message\ResponseInterface The HTTP response.
	 */
	public function checkError(ResponseInterface $response): ?ResponseInterface {
		if ($response->getStatusCode() < 400) {
			return $response;
		}

		$body = (string) $response->getBody();
		$responseBody = json_decode($body, true, 512, JSON_INVALID_UTF8_SUBSTITUTE | JSON_THROW_ON_ERROR);
		$errorList = [];

		if (is_array($responseBody)) {
			if (!empty($responseBody['error'])) {
				$errorList['error'] = $responseBody['error'];
			}

			if (!empty($responseBody['errors']) && is_array($responseBody['errors'])) {
				$errorList['errors'] = $responseBody['errors'];
			}

			if (!empty($errorList['error']) && empty($errorList['errors'])) {
				$errorList = implode(PHP_EOL, $errorList);
			} else if (!empty($errorList['errors'])) {
				$errorList = json_encode($errorList, JSON_INVALID_UTF8_SUBSTITUTE | JSON_PRESERVE_ZERO_FRACTION | JSON_THROW_ON_ERROR);
			}

			$message = sprintf(
				'[%d] Mailrelay API request failed: %2$s',
				$response->getStatusCode(),
				$errorList
			);

			throw new \ErrorException($message, $response->getStatusCode());
		}

		throw new \RuntimeException($body, $response->getStatusCode());
	}
}
