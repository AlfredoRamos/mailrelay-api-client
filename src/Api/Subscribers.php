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

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = [
			'status',
			'email'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('subscribers', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('subscribers/%d', $itemId));
	}

	public function deleteSubscriber(int $itemId = 0) {
		return $this->request->delete(sprintf('subscribers/%d', $itemId));
	}

	public function updateSubscriber(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);

		return $this->request->patch(
			sprintf('subscribers/%d', $itemId),
			['json' => $data]
		);
	}

	public function banSubscriber(int $itemId = 0) {
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

	public function sync(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = [
			'status',
			'email'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('subscribers/sync', ['json' => $data]);
	}
}
