<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

use AlfredoRamos\Mailrelay\Http\Client as HttpClient;
use AlfredoRamos\Mailrelay\Pager\PagerInterface;

class Request implements RequestInterface {
	private $httpClient;
	private $pager;

	public function __construct(array $options = [], PagerInterface $pager = null) {
		if (empty($this->httpClient)) {
			$this->httpClient = new HttpClient($options);
		}

		$this->pager = $pager;
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
		$response = $this->httpClient->patch($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}

	public function delete(string $url = '', array $parameters = []) {
		$response = $this->httpClient->delete($url, $parameters);

		return $this->httpClient->parseResponse($response);
	}
}
