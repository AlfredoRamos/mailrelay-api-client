<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class CampaignFolders extends AbstractApi {
	public function getList() {
		return $this->get('campaign_folders');
	}

	public function addFolder($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new campaign folder.');
		}

		$required = ['name'];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to add a new campaign folder: ' . implode(', ', $invalid));
		}

		return $this->post('campaign_folders', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('campaign_folders/%d', $itemId));
	}

	public function deleteFolder(int $itemId = 0) {
		return $this->delete(sprintf('campaign_folders/%d', $itemId));
	}

	public function updateFolder(int $itemId = 0, $data = []) {
		return $this->patch(s
			printf('campaign_folders/%d', $itemId),
			['json' => $data]
		);
	}
}
