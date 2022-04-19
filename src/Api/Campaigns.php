<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Campaigns extends AbstractApi {
	/**
	 * List campaigns.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('campaigns', ['query' => $data]);
	}

	/**
	 * Add a new campaign.
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
			'target'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('campaigns', ['json' => $data]);
	}

	/**
	 * Get a campaign by ID.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0) {
		return $this->request->get(sprintf('campaigns/%d', $itemId));
	}

	/**
	 * Remove a campaign.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function delete(int $itemId = 0) {
		return $this->request->delete(sprintf('campaigns/%d', $itemId));
	}

	/**
	 * Update a campaign.
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
			sprintf('campaigns/%d', $itemId),
			['json' => $data]
		);
	}

	/**
	 * Send a campaign.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function send(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['target'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post(
			sprintf('campaigns/%d/send_all', $itemId),
			['json' => $data]
		);
	}

	/**
	 * Send a campaign to test emails.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
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
