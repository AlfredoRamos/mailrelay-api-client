<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Package extends AbstractApi {
	/**
	 * Get account package info.
	 *
	 * @return array Response data.
	 */
	public function info() {
		return $this->request->get('package');
	}
}
