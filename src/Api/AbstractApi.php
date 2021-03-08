<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

use AlfredoRamos\Mailrelay\Client;

abstract class AbstractApi {
	protected $client;
	protected $pager;
	protected $httpClient;

	public function __construct(Client $client, PagerInterface $pager = null) {
		$this->client = $client;
		$this->pager = $pager;
		$this->httpClient = $this->client->getHttpClient();
	}

	public function get(string $url = '', array $parameters = []) {
		if (!empty($this->pager)) {
			$parameters['page'] = $this->pager->getPage();
			$parameters['per_page'] = $this->pager->getResultsPerPage();
		}

		$response = $this->httpClient->get($url, ['query' => $parameters]);

		return $this->httpClient->parseResponse($response);
	}

	public function post(string $url = '', array $parameters = []) {
		$response = $this->httpClient->post($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}

	public function patch(string $url = '', array $parameters = []) {
		$response = $this->httpClient->put($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}

	public function delete(string $url = '', array $parameters = []) {
		$response = $this->httpClient->delete($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}
}
