<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface {
	/**
	 * Send HTTP GET request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return \Psr7\Http\Message\ResponseInterface
	 */
	public function get(string $url = '', array $parameters = []): ResponseInterface;

	/**
	 * Send HTTP POST request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return \Psr7\Http\Message\ResponseInterface
	 */
	public function post(string $url = '', array $parameters = []): ResponseInterface;

	/**
	 * Send HTTP PATCH request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return \Psr7\Http\Message\ResponseInterface
	 */
	public function patch(string $url = '', array $parameters = []): ResponseInterface;

	/**
	 * Send HTTP DELETE request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return \Psr7\Http\Message\ResponseInterface
	 */
	public function delete(string $url = '', array $parameters = []): ResponseInterface;

	/**
	 * Sent HTTP request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 * @param string	$method		The HTTP method.
	 *
	 * @return \Psr7\Http\Message\ResponseInterface The HTTP request.
	 */
	public function sendRequest(string $url = '', array $parameters = [], string $method = 'GET'): ResponseInterface;

	/**
	 * Parse HTTP response.
	 *
	 * @param \Psr\Http\Message\ResponseInterface $response The HTTP response.
	 *
	 * @return array The response body.
	 */
	public function parseResponse(ResponseInterface $response = null): array;
}
