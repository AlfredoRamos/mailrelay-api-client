<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Groups extends AbstractApi {
	public function getList() {
		return $this->get('groups');
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('groups/%d', $itemId));
	}
}
