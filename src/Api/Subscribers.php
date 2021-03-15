<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Subscribers extends AbstractApi {
	/**
	 * List subscribers.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('subscribers', ['query' => $data]);
	}

	/**
	 * Add a new subscriber.
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
			'status',
			'email'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('subscribers', ['json' => $data]);
	}

	/**
	 * Get a subscriber by ID.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0, array $data = []) {
		return $this->request->get(
			sprintf('subscribers/%d', $itemId),
			['query' => $data]
		);
	}

	/**
	 * Remove a subscriber.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function delete(int $itemId = 0) {
		return $this->request->delete(sprintf('subscribers/%d', $itemId));
	}

	/**
	 * Update a subscriber.
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
			sprintf('subscribers/%d', $itemId),
			['json' => $data]
		);
	}

	/**
	 * Ban a subscriber.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function ban(int $itemId = 0) {
		return $this->request->patch(sprintf('subscribers/%d/ban', $itemId));
	}

	/**
	 * Resend confirmation email to an inactive subscriber.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function resendConfirmation(int $itemId = 0) {
		return $this->request->post(sprintf('subscribers/%d/resend_confirmation_email', $itemId));
	}

	/**
	 * Restore a deleted subscriber.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function restore(int $itemId = 0) {
		return $this->request->patch(sprintf('subscribers/%d/restore', $itemId));
	}

	/**
	 * Unban a subscriber.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function unban(int $itemId = 0) {
		return $this->request->patch(sprintf('subscribers/%d/unban', $itemId));
	}

	/**
	 * Get deleted subscribers.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @return array Response data.
	 */
	public function deleted() {
		return $this->request->get('subscribers/deleted', ['query' => $data]);
	}

	/**
	 * Create or update a subscriber.
	 *
	 * @param array $data Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function sync(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = [
			'status',
			'email'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('subscribers/sync', ['json' => $data]);
	}
}
