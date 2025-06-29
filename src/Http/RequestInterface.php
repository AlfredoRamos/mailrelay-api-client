<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

interface RequestInterface {
	/** @var array */
	const ALLOWED_METHODS = ['GET', 'POST', 'PATCH', 'DELETE'];

	/**
	 * Send HTTP GET request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return \Psr7\Http\Message\RequestInterface The HTTP request.
	 */
	public function get(string $url = '', array $parameters = []);

	/**
	 * Send HTTP POST request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return \Psr7\Http\Message\RequestInterface The HTTP request.
	 */
	public function post(string $url = '', array $parameters = []);

	/**
	 * Send HTTP PATCH request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return \Psr7\Http\Message\RequestInterface The HTTP request.
	 */
	public function patch(string $url = '', array $parameters = []);

	/**
	 * Send HTTP DELETE request.
	 *
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 *
	 * @return \Psr7\Http\Message\RequestInterface The HTTP request.
	 */
	public function delete(string $url = '', array $parameters = []);

	/**
	 * Send dynamic HTTP raw request.
	 * @param string	$url		The URL to send the request to.
	 * @param array		$parameters	The request parameters.
	 * @param string	$method		The HTTP method (GET, POST, PATCH, DELETE).
	 *
	 * @return null|\Psr7\Http\Message\RequestInterface The HTTP request.
	 */
	public function raw(string $url = '', array $parameters = [], string $method = 'GET');
}
