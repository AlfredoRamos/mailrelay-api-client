<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class CustomFields extends AbstractApi {
	public function getList() {
		return $this->request->get('custom_fields');
	}

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = [
			'label',
			'tag_name',
			'field_type'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('custom_fields', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('custom_fields/%d', $itemId));
	}

	public function deleteCustomField(int $itemId = 0) {
		return $this->request->delete(sprintf('custom_fields/%d', $itemId));
	}

	public function updateCustomField(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);

		return $this->request->patch(
			sprintf('custom_fields/%d', $itemId),
			['json' => $data]
		);
	}
}
