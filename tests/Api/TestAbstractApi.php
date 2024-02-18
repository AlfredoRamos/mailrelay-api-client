<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Tests\Api;

use AlfredoRamos\Mailrelay\Api\AbstractApi;

class TestAbstractApi extends AbstractApi {
	public function getRequest() {
		return $this->request;
	}

	public function getValidator() {
		return $this->validator;
	}

	public function getSanitize() {
		return $this->sanitize;
	}
}
