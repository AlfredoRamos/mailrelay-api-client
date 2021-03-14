<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class MediaFiles extends AbstractApi {
	public function getList() {
		return $this->request->get('media_files');
	}

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = [
			'file' => ['name', 'content']
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('media_files', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('media_files/%d', $itemId));
	}

	public function deleteMediaFile(int $itemId = 0) {
		return $this->request->delete(sprintf('media_files/%d', $itemId));
	}

	public function moveToTrash(int $itemId = 0) {
		return $this->request->patch(sprintf('media_files/%d/move_to_trash', $itemId));
	}

	public function restore(int $itemId = 0) {
		return $this->request->patch(sprintf('media_files/%d/restore', $itemId));
	}

	public function trashed() {
		return $this->request->get('media_files/trashed');
	}
}
