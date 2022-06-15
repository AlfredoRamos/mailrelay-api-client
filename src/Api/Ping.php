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
		return $this->request->get('ping');
	}
}
