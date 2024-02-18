<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class RssCampaigns extends AbstractApi {
	/**
	 * List RSS campaigns.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('rss_campaigns', ['query' => $data]);
	}

	/**
	 * Add a new RSS campaign.
	 *
	 * @param array $data Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function add(array $data = []) {
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

	/**
	 * Get a RSS campaign by ID.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0) {
		return $this->request->get(sprintf('rss_campaigns/%d', $itemId));
	}

	/**
	 * Remove a RSS campaign.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function delete(int $itemId = 0) {
		return $this->request->delete(sprintf('rss_campaigns/%d', $itemId));
	}

	/**
	 * Update a RSS campaign.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function update(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);

		return $this->request->patch(
			sprintf('rss_campaigns/%d', $itemId),
			['json' => $data]
		);
	}

	/**
	 * Get RSS campaign's pprocessed entries.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @return array Response data.
	 */
	public function processed(int $itemId = 0, array $data = []) {
		return $this->request->get(
			sprintf('rss_campaigns/%d/processed_entries', $itemId),
			['query' => $data]
		);
	}
}
