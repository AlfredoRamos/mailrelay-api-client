<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

interface ResponseInterface
{
	/**
	 * Response constructor.
	 *
	 * @param \Psr\Http\Message\ResponseInterface $response The HTTP response.
	 *
	 * @return void
	 */
	public function __construct(PsrResponseInterface $response);

	/**
	 * Get the response body as an array.
	 *
	 * @return array
	 */
	public function toArray();

	/**
	 * Get the response body as a JSON string.
	 *
	 * @return string
	 */
	public function toJson();

	/**
	 * Get the response headers.
	 *
	 * @return array
	 */
	public function getHeaders();

	/**
	 * Get a specific header value.
	 *
	 * @param string $name Header name.
	 *
	 * @return array
	 */
	public function getHeader(string $name);

	/**
	 * Get the HTTP status code.
	 *
	 * @return int
	 */
	public function getStatusCode();

	/**
	 * The total number of pages based on your parameters.
	 *
	 * @return int|null
	 */
	public function totalPages();

	/**
	 * The number of records returned per page.
	 *
	 * @return int|null
	 */
	public function perPage();
}
