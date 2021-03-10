<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Senders extends AbstractApi {
	public function getList() {
		return $this->get('senders');
	}

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new sender.');
		}

		$required = [
			'name',
			'email'
		];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to add a new sender: ' . implode(', ', $invalid));
		}

		return $this->post('senders', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('senders/%d', $itemId));
	}

	public function deleteSender(int $itemId = 0) {
		return $this->delete(sprintf('senders/%d', $itemId));
	}

	public function updateSender(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new sender.');
		}

		return $this->patch(
			sprintf('senders/%d', $itemId),
			['json' => $data]
		);
	}

	public function sendConfirmation(int $itemId = 0) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new sender.');
		}

		return $this->post(sprintf('senders/%d/send_confirmation_email', $itemId));
	}
}
