<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

interface ClientInterface {
	/**
	 * Sent HTTP request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 * @param string	$method		The HTTP method.
	 *
	 * @return \Psr7\Http\Message\RequestInterface The HTTP request.
	 */
	public function sendRequest(string $url = '', array $parameters = [], string $method = 'GET');

	/**
	 * Parse HTTP response.
	 *
	 * @param \Psr\Http\Message\ResponseInterface $response The HTTP response.
	 *
	 * @return array The response body.
	 */
	public function parseResponse($response);
}
