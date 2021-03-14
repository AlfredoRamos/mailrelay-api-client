<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class UnsubscribeEvents extends AbstractApi {
	public function getList() {
		return $this->request->get('unsubscribe_events');
	}

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['sent_email_id'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('unsubscribe_events', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('unsubscribe_events/%d', $itemId));
	}

	public function deleteEvent(int $itemId = 0) {
		return $this->request->delete(sprintf('unsubscribe_events/%d', $itemId));
	}
}
