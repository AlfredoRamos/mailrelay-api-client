<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Imports extends AbstractApi {
	/**
	 * List imports.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('imports', ['query' => $data]);
	}

	/**
	 * Import a new file.
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
			'file' => ['name', 'content'],
			'import_fields_attributes' => ['column', 'field']
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('imports', ['json' => $data]);
	}

	/**
	 * Get a import by ID.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0) {
		return $this->request->get(sprintf('imports/%d', $itemId));
	}

	/**
	 * Cancel a import that is in progress.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function cancel(int $itemId = 0) {
		return $this->request->patch(sprintf('imports/%d/cancel', $itemId));
	}

	/**
	 * Get line by line data of a import.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @return array Response data.
	 */
	public function data(int $itemId = 0, array $data = []) {
		return $this->request->get(
			sprintf('imports/%d/data', $itemId),
			['query' => $data]
		);
	}
}
