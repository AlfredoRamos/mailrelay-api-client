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

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = [
			'sender_id',
			'subject',
			'html',
			'target',
			'url',
			'frequency',
			'number_of_entries'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('rss_campaigns', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('rss_campaigns/%d', $itemId));
	}

	public function deleteCampaign(int $itemId = 0) {
		return $this->request->delete(sprintf('rss_campaigns/%d', $itemId));
	}

	public function updateCampaign(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);

		return $this->request->patch(
			sprintf('rss_campaigns/%d', $itemId),
			['json' => $data]
		);
	}

	public function getProcessed(int $itemId = 0) {
		return $this->request->get(sprintf('rss_campaigns/%d/processed_entries', $itemId));
	}
}
