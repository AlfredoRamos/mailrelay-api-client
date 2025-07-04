<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

use AlfredoRamos\Mailrelay\Http\RequestInterface as HttpRequestInterface;
use AlfredoRamos\Mailrelay\Middleware\Auth as AuthMiddleware;
use AlfredoRamos\Mailrelay\Middleware\Error as ErrorMiddleware;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

class Client implements HttpRequestInterface, ClientInterface {
	/** @var string */
	protected $options = [];

	/** @var \GuzzleHttp\Client */
	protected $client;

	/** @var \GuzzleHttp\HandlerStack */
	protected $stack;

	/**
	 * HTTP client constructor.
	 *
	 * @param array $options Configuration options.
	 *
	 * @return void
	 */
	public function __construct(array $options = []) {
		$this->options = array_merge($this->options, $options);
		$this->stack = HandlerStack::create();
		$this->stack->push(ErrorMiddleware::error());

		// Set authentication token header
		$token = $this->options['api_token'];
		$this->stack->push(Middleware::mapRequest(function (RequestInterface $request) use ($token) {
			return (new AuthMiddleware($token))->addAuthHeader($request);
		}));

		if (empty($this->client)) {
			$this->client = new GuzzleClient([
				'base_uri' => sprintf(
					'https://%s.ipzmarketing.com/api/v1/',
					$this->options['api_account']
				),
				'handler' => $this->stack
			]);
		}
	}

	/**
	 * Set options for the request.
	 *
	 * @param array $options Options to set.
	 *
	 * @return $this
	 */
	public function withOptions(array $options = []) {
		unset($options['api_token'], $options['api_account']);

		$this->options = array_merge($this->options, $options);

		return $this;
	}

	/**
	 * {@inheritDoc}
	 */
	public function get(string $url = '', array $parameters = []) {
		return $this->sendRequest($url, $parameters, 'GET');
	}

	/**
	 * {@inheritDoc}
	 */
	public function post(string $url = '', array $parameters = []) {
		return $this->sendRequest($url, $parameters, 'POST');
	}

	/**
	 * {@inheritDoc}
	 */
	public function patch(string $url = '', array $parameters = []) {
		return $this->sendRequest($url, $parameters, 'PATCH');
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete(string $url = '', array $parameters = []) {
		return $this->sendRequest($url, $parameters, 'DELETE');
	}

	/**
	 * {@inheritDoc}
	 */
	public function raw(string $url = '', array $parameters = [], string $method = 'GET') {
		$method = trim(strtoupper($method));

		if (empty($method) || !in_array($method, HttpRequestInterface::ALLOWED_METHODS, true)) {
			return;
		}

		return $this->sendRequest($url, $parameters, $method);
	}

	/**
	 * {@inheritDoc}
	 */
	public function sendRequest(string $url = '', array $parameters = [], string $method = 'GET') {
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

		if (in_array($method, ['POST', 'PATCH', 'DELETE'])) {
			$options['form_params'] = $parameters;
		}

		return $this->client->request($method, $url, $options);
	}

	/**
	 * {@inheritDoc}
	 */
	public function parseResponse($response) {
		$responseBody = ['error' => 'Unknown error.'];

		if ($response) {
			if (!empty($this->options['full_response']) && $this->options['full_response'] === true) {
				unset($this->options['full_response']);
				return new Response($response);
			}

			$responseBody = json_decode($response->getBody(), true);
		}

		unset($this->options['full_response']);
		return $responseBody;
	}
}
