<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class RssCampaigns extends AbstractApi {
	public function getList() {
		return $this->request->get('rss_campaigns');
	}

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new RSS campaign.');
		}

		$required = [
			'sender_id',
			'subject',
			'html',
			'target',
			'url',
			'frequency',
			'number_of_entries'
		];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to add a new RSS campaign: ' . implode(', ', $invalid));
		}

		return $this->request->post('rss_campaigns', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('rss_campaigns/%d', $itemId));
	}

	public function deleteCampaign(int $itemId = 0) {
		return $this->request->delete(sprintf('rss_campaigns/%d', $itemId));
	}

	public function updateCampaign(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to update RSS campaign.');
		}

		return $this->request->patch(
			sprintf('rss_campaigns/%d', $itemId),
			['json' => $data]
		);
	}

	public function getProcessed(int $itemId = 0) {
		return $this->request->get(sprintf('rss_campaigns/%d/processed_entries', $itemId));
	}
}
