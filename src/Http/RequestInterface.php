<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

interface RequestInterface {
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
}
