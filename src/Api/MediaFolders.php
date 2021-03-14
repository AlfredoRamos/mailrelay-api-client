<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class MediaFolders extends AbstractApi {
	public function getList() {
		return $this->request->get('media_folders');
	}

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['name'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('media_folders', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('media_folders/%d', $itemId));
	}

	public function deleteMediaFolder(int $itemId = 0) {
		return $this->request->delete(sprintf('media_folders/%d', $itemId));
	}

	public function updateMediaFolder(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);

		return $this->request->patch(
			sprintf('media_folders/%d', $itemId),
			['json' => $data]
		);
	}
}
