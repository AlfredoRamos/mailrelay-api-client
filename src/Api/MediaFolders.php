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

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new media folder.');
		}

		$required = ['name'];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to add a new media folder: ' . implode(', ', $invalid));
		}

		return $this->request->post('media_folders', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('media_folders/%d', $itemId));
	}

	public function deleteMediaFolder(int $itemId = 0) {
		return $this->request->delete(sprintf('media_folders/%d', $itemId));
	}

	public function updateMediaFolder(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to update media folder.');
		}

		return $this->request->patch(
			sprintf('media_folders/%d', $itemId),
			['json' => $data]
		);
	}
}
