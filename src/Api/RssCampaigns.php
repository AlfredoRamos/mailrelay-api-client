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
		return $this->get('rss_campaigns');
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

		return $this->post('rss_campaigns', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('rss_campaigns/%d', $itemId));
	}

	public function deleteCampaign(int $itemId = 0) {
		return $this->delete(sprintf('rss_campaigns/%d', $itemId));
	}

	public function updateCampaign(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to update RSS campaign.');
		}

		return $this->patch(
			sprintf('rss_campaigns/%d', $itemId),
			['json' => $data]
		);
	}

	public function getProcessed(int $itemId = 0) {
		return $this->get(sprintf('rss_campaigns/%d/processed_entries', $itemId));
	}
}
