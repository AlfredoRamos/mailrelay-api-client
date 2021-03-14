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
	public function getList() {
		return $this->request->get('api_batches');
	}

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = [
			'operations_attributes' => ['request_method', 'request_path']
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('api_batches', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('api_batches/%d', $itemId));
	}
}
