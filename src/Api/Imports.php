<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Imports extends AbstractApi {
	public function getList() {
		return $this->request->get('imports');
	}

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = [
			'file' => ['name', 'content'],
			'import_fields_attributes' => ['column', 'field']
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('imports', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('imports/%d', $itemId));
	}

	public function cancelImport(int $itemId = 0) {
		return $this->request->patch(sprintf('imports/%d/cancel', $itemId));
	}

	public function getContents(int $itemId = 0) {
		return $this->request->get(sprintf('imports/%d/data', $itemId));
	}
}
