<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Middleware;

use Psr\Http\Message\RequestInterface;

class Auth {
	/**	@var string */
	private $token;

	/**
	 * Auth middleware constructor.
	 *
	 * @param string $token The authentication token.
	 *
	 * @return void
	 */
	public function __construct(string $token = '') {
		$this->token = $token;
	}

	/**
	 * Add authentication token header.
	 *
	 * @param \Psr\Http\Message\RequestInterface The HTTP request.
	 *
	 * @return \Psr\Http\Message\RequestInterface The HTTP request with the authentication token header.
	 */
	public function addAuthHeader(RequestInterface $request) {
		return $request->withHeader('X-Auth-Token', $this->token);
	}
}
