<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Ping extends AbstractApi {
	/**
	 * Verify if the API key was sent and is valid.
	 *
	 * @return array Response data.
	 */
	public function info() {
		$response = $this->request->raw('ping');
		$statusCode = $response->getStatusCode();
		$statusMessage = '';

		switch ($statusCode) {
			case 204:
				$statusMessage = 'API key is valid.';
				break;

			case 401:
				$statusMessage = 'The API key wasn\'t sent or is invalid.';
				break;

			case 404:
				$statusMessage = 'Account not found.';
				break;

			case 500:
				$statusMessage = 'An internal error happened. Try again later.';
				break;

			default:
				$statusMessage = 'Unknown error.';
				break;
		}

		$body = ['status' => $statusCode, 'message' => $statusMessage];

		return $body;
	}
}
