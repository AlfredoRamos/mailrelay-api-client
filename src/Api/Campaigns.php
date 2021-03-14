<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Campaigns extends AbstractApi {
	public function getList() {
		return $this->request->get('campaigns');
	}

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);

		$required = [
			'sender_id',
			'subject',
			'html',
			'target'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('campaigns', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('campaigns/%d', $itemId));
	}

	public function deleteCampaign(int $itemId = 0) {
		return $this->request->delete(sprintf('campaigns/%d', $itemId));
	}

	public function updateCampaign(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);

		return $this->request->patch(
			sprintf('campaigns/%d', $itemId),
			['json' => $data]
		);
	}

	public function sendCampaign(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['target'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post(
			sprintf('campaigns/%d/send_all', $itemId),
			['json' => $data]
		);
	}

	public function sendTest(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['test_emails'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post(
			sprintf('campaigns/%d/send_test', $itemId),
			['json' => $data]
		);
	}
}
