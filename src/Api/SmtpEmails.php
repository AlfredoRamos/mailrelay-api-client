<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class SmtpEmails extends AbstractApi {
	public function getList() {
		return $this->get('smtp_emails');
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('smtp_emails/%d', $itemId));
	}
}
