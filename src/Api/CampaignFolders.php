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
		return $this->request->get('campaign_folders');
	}

	public function addFolder(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['name'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('campaign_folders', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('campaign_folders/%d', $itemId));
	}

	public function deleteFolder(int $itemId = 0) {
		return $this->request->delete(sprintf('campaign_folders/%d', $itemId));
	}

	public function updateFolder(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);

		return $this->request->patch(
			sprintf('campaign_folders/%d', $itemId),
			['json' => $data]
		);
	}
}
