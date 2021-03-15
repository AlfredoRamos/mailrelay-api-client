<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class UnsubscribeEvents extends AbstractApi {
	/**
	 * List unsubscribe events.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('unsubscribe_events', ['query' => $data]);
	}

	/**
	 * Add a new unsubscribe event.
	 *
	 * @param array $data Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function add(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['sent_email_id'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('unsubscribe_events', ['json' => $data]);
	}

	/**
	 * Get an unsubscribe event by ID.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0) {
		return $this->request->get(sprintf('unsubscribe_events/%d', $itemId));
	}

	/**
	 * Remove an unsubscribe event.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function delete(int $itemId = 0) {
		return $this->request->delete(sprintf('unsubscribe_events/%d', $itemId));
	}
}
