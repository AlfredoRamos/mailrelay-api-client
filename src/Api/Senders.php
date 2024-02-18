<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Senders extends AbstractApi {
	/**
	 * List senders.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('senders', ['query' => $data]);
	}

	/**
	 * Add a new sender.
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
			'name',
			'email'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('senders', ['json' => $data]);
	}

	/**
	 * Get a sender by ID.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0) {
		return $this->request->get(sprintf('senders/%d', $itemId));
	}

	/**
	 * Remove a sender.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function delete(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['new_sender_id'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->delete(
			sprintf('senders/%d', $itemId),
			['json' => $data]
		);
	}

	/**
	 * Update a sender.
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
			sprintf('senders/%d', $itemId),
			['json' => $data]
		);
	}

	/**
	 * Send confirmation email.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function sendConfirmation(int $itemId = 0) {
		return $this->request->post(sprintf('senders/%d/send_confirmation_email', $itemId));
	}
}
