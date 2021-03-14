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

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new unsubscribe event.');
		}

		$required = ['sent_email_id'];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to add a new unsubscribe event: ' . implode(', ', $invalid));
		}

		return $this->request->post('unsubscribe_events', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('unsubscribe_events/%d', $itemId));
	}

	public function deleteEvent(int $itemId = 0) {
		return $this->request->delete(sprintf('unsubscribe_events/%d', $itemId));
	}
}
