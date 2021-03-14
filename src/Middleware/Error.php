<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Error {
	private $nextHandler;

	public function __construct(callable $nextHandler) {
		$this->nextHandler = $nextHandler;
	}

	public function __invoke(RequestInterface $request, array $options) {
		$fn = $this->nextHandler;

		return $fn($request, $options)->then(function (ResponseInterface $response) {
			return $this->checkError($response);
		});
	}

	public static function error() {
		return function (callable $handler) {
			return new self($handler);
		};
	}

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
			throw new \ErrorException($message, $response->getStatusCode());
		}

		throw new \RuntimeException($responseBody, $response->getStatusCode());
	}
}
