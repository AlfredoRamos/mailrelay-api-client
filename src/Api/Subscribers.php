<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Subscribers extends AbstractApi {
	public function getList() {
		return $this->get('subscribers');
	}

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new subscriber.');
		}

		$required = [
			'status',
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
			throw new \InvalidArgumentException('Missing required data to add a new subscriber: ' . implode(', ', $invalid));
		}

		return $this->post('subscribers', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('subscribers/%d', $itemId));
	}

	public function deleteSubscriber(int $itemId = 0) {
		return $this->delete(sprintf('subscribers/%d', $itemId));
	}

	public function updateSubscriber(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to update subscriber.');
		}

		return $this->patch(
			sprintf('subscribers/%d', $itemId),
			['json' => $data]
		);
	}

	public function banSubscriber(int $itemId = 0, $data = []) {
		return $this->patch(sprintf('subscribers/%d/ban', $itemId));
	}

	public function resendConfirmation(int $itemId = 0) {
		return $this->post(sprintf('subscribers/%d/resend_confirmation_email', $itemId));
	}

	public function restoreSubscriber(int $itemId = 0) {
		return $this->patch(sprintf('subscribers/%d/restore', $itemId));
	}

	public function unbanSubscriber(int $itemId = 0) {
		return $this->patch(sprintf('subscribers/%d/unban', $itemId));
	}

	public function getDeleted() {
		return $this->get('subscribers/deleted');
	}

	public function sync($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to sync subscriber.');
		}

		$required = [
			'status',
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
			throw new \InvalidArgumentException('Missing required data to sync subscriber: ' . implode(', ', $invalid));
		}

		return $this->post('subscribers/sync', ['json' => $data]);
	}
}
