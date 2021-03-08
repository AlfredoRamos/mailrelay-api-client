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
	private $token;

	public function __construct(string $token = '') {
		$this->token = $token;
	}

	public function addAuthHeader(RequestInterface $request) {
		return $request->withHeader('X-Auth-Token', $this->token);
	}
}
