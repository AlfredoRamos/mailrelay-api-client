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

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new campaign.');
		}

		$required = [
			'sender_id',
			'subject',
			'html',
			'target'
		];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to add a new campaign: ' . implode(', ', $invalid));
		}

		return $this->request->post('campaigns', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('campaigns/%d', $itemId));
	}

	public function deleteCampaign(int $itemId = 0) {
		return $this->request->delete(sprintf('campaigns/%d', $itemId));
	}

	public function updateCampaign(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to update campaign.');
		}

		return $this->request->patch(
			sprintf('campaigns/%d', $itemId),
			['json' => $data]
		);
	}

	public function sendCampaign(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to send campaign.');
		}

		$required = ['target'];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to send campaign: ' . implode(', ', $invalid));
		}

		return $this->request->post(
			sprintf('campaigns/%d/send_all', $itemId),
			['json' => $data]
		);
	}

	public function sendTest(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to send test campaign.');
		}

		$required = ['test_emails'];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to send test campaign: ' . implode(', ', $invalid));
		}

		return $this->request->post(
			sprintf('campaigns/%d/send_test', $itemId),
			['json' => $data]
		);
	}
}
