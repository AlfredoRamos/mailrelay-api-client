<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

use Psr\Http\Message\ResponseInterface;

interface RequestInterface
{
	/** @var array */
	const ALLOWED_METHODS = ['GET', 'POST', 'PATCH', 'DELETE'];

	/**
	 * Send HTTP GET request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return array
	 */
	public function get(string $url = '', array $parameters = []): array;

	/**
	 * Send HTTP POST request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return array
	 */
	public function post(string $url = '', array $parameters = []): array;

	/**
	 * Send HTTP PATCH request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return array
	 */
	public function patch(string $url = '', array $parameters = []): array;

	/**
	 * Send HTTP DELETE request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return array
	 */
	public function delete(string $url = '', array $parameters = []): array;

	/**
	 * Send dynamic HTTP raw request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 * @param string	$method		The HTTP method (GET, POST, PATCH, DELETE).
	 *
	 * @return \Psr\Http\Message\ResponseInterface|null The HTTP response.
	 */
	public function raw(string $url = '', array $parameters = [], string $method = 'GET'): ?ResponseInterface;
}
