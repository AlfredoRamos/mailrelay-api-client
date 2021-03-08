<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class AbTests extends AbstractApi {
	public function getList() {
		return $this->get('ab_tests');
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('ab_tests/%d', $itemId));
	}
}
