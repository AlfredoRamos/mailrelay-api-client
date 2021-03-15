<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class ApiBatches extends AbstractApi {
	/**
	 * List API batches.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('api_batches', ['query' => $data]);
	}

	/**
	 * Add a new API batch.
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
			'operations_attributes' => ['request_method', 'request_path']
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('api_batches', ['json' => $data]);
	}

	/**
	 * Get a API batch by ID.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0, array $data = []) {
		return $this->request->get(
			sprintf('api_batches/%d', $itemId),
			['query' => $data]
		);
	}
}
