<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class Groups extends AbstractApi {
	public function getList() {
		return $this->request->get('groups');
	}

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['name'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('groups', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('groups/%d', $itemId));
	}

	public function deleteGroup(int $itemId = 0) {
		return $this->request->delete(sprintf('groups/%d', $itemId));
	}

	public function updateGroup(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);

		return $this->request->patch(
			sprintf('groups/%d', $itemId),
			['json' => $data]
		);
	}
}
