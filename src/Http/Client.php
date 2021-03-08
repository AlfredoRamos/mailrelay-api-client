<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

use AlfredoRamos\Mailrelay\Middleware\Auth as AuthMiddleware;
use AlfredoRamos\Mailrelay\Middleware\Error as ErrorMiddleware;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

class Client implements ClientInterface {
	protected $options = [];

	protected $client;

	protected $stack;

	public function __construct(array $options = []) {
		$this->options = array_merge($this->options, $options);
		$this->stack = HandlerStack::create();
		$this->stack->push(ErrorMiddleware::error());

		$token = $this->options['api_token'];
		$this->stack->push(Middleware::mapRequest(function (RequestInterface $request) use ($token) {
			return (new AuthMiddleware($token))->addAuthHeader($request);
		}));

		if (!isset($this->client)) {
			$this->client = new GuzzleClient([
				'base_uri' => sprintf(
					'https://%s.ipzmarketing.com/api/v1/',
					$this->options['api_account']
				),
				'handler' => $this->stack
			]);
		}
	}

	public function get(string $url = '', array $parameters = []) {
		return $this->sendRequest($url, $parameters, 'GET');
	}

	public function post(string $url = '', array $parameters = []) {
		return $this->sendRequest($url, $parameters, 'POST');
	}

	public function patch(string $url = '', array $parameters = []) {
		return $this->sendRequest($url, $parameters, 'PATCH');
	}

	public function delete(string $url = '', array $parameters = []) {
		return $this->sendRequest($url, $parameters, 'DELETE');
	}

	public function sendRequest(string $url = '', array $parameters = [], $method = 'GET') {
		$options = [];

		if (!empty($parameters['headers'])) {
			$options['headers'] = $parameters['headers'];
		}

		if (!empty($parameters['query'])) {
			$options['query'] = $parameters['query'];
		}

		if (!empty($parameters['json'])) {
			$options['json'] = $parameters['json'];
		}

		if (in_array($method, ['POST', 'DELETE'])) {
			$options['form_params'] = $parameters;
		}

		return $this->client->request($method, $url, $options);
	}

	public function parseResponse($response) {
		$responseBody = ['error' => 'Unknown error.'];

		if ($response) {
			$responseBody = json_decode($response->getBody(), true);
		}

		return $responseBody;
	}
}
