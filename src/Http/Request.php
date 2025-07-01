<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

use AlfredoRamos\Mailrelay\Http\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

class Request implements RequestInterface {
	/** @var \AlfredoRamos\Mailrelay\Http\Client */
	private $httpClient;

	/**
	 * HTTP request helper constructor.
	 *
	 * @param array $options Configuration options.
	 *
	 * @return void
	 */
	public function __construct(array $options = []) {
		if (empty($this->httpClient)) {
			$this->httpClient = new HttpClient($options);
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function get(string $url = '', array $parameters = []): array {
		$response = $this->httpClient->get($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}

	/**
	 * {@inheritDoc}
	 */
	public function post(string $url = '', array $parameters = []): array {
		$response = $this->httpClient->post($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}

	/**
	 * {@inheritDoc}
	 */
	public function patch(string $url = '', array $parameters = []): array {
		$response = $this->httpClient->patch($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete(string $url = '', array $parameters = []): array {
		$response = $this->httpClient->delete($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}

	/**
	 * {@inheritDoc}
	 */
	public function raw(string $url = '', array $parameters = [], string $method = 'GET'): ?ResponseInterface {
		$method = trim(strtoupper($method));

		if (empty($method) || !in_array($method, RequestInterface::ALLOWED_METHODS, true)) {
			return null;
		}

		return $this->httpClient->sendRequest($url, $parameters, $method);
	}
}
