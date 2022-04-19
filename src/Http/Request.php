<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

use AlfredoRamos\Mailrelay\Http\Client as HttpClient;

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
	public function get(string $url = '', array $parameters = []) {
		$response = $this->httpClient->get($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}

	/**
	 * {@inheritDoc}
	 */
	public function post(string $url = '', array $parameters = []) {
		$response = $this->httpClient->post($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}

	/**
	 * {@inheritDoc}
	 */
	public function patch(string $url = '', array $parameters = []) {
		$response = $this->httpClient->patch($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete(string $url = '', array $parameters = []) {
		$response = $this->httpClient->delete($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}
}
