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
		return $this->request->get('subscribers');
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

		return $this->request->post('subscribers', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('subscribers/%d', $itemId));
	}

	public function deleteSubscriber(int $itemId = 0) {
		return $this->request->delete(sprintf('subscribers/%d', $itemId));
	}

	public function updateSubscriber(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to update subscriber.');
		}

		return $this->request->patch(
			sprintf('subscribers/%d', $itemId),
			['json' => $data]
		);
	}

	public function banSubscriber(int $itemId = 0, $data = []) {
		return $this->request->patch(sprintf('subscribers/%d/ban', $itemId));
	}

	public function resendConfirmation(int $itemId = 0) {
		return $this->request->post(sprintf('subscribers/%d/resend_confirmation_email', $itemId));
	}

	public function restoreSubscriber(int $itemId = 0) {
		return $this->request->patch(sprintf('subscribers/%d/restore', $itemId));
	}

	public function unbanSubscriber(int $itemId = 0) {
		return $this->request->patch(sprintf('subscribers/%d/unban', $itemId));
	}

	public function getDeleted() {
		return $this->request->get('subscribers/deleted');
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

		return $this->request->post('subscribers/sync', ['json' => $data]);
	}
}
