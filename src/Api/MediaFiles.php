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
		return $this->get('media_files');
	}

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new media file.');
		}

		$required = [
			'file' => ['name', 'content']
		];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $key => $value) {
			if (is_numeric($key) && empty($data[$value])) {
				$invalid[] = $value;
			}

			if (is_string($key) && is_array($value)) {
				$inv = [];

				if (empty($data[$key])) {
					$inv = $required[$key];
				}

				foreach ($value as $item) {
					if (empty($data[$key][$item]) && !in_array($item, $inv)) {
						$inv[] = $item;
					}
				}

				if (!empty($inv)) {
					$invalid[] = sprintf('%s[%s]', $key, implode(',', $inv));
				}
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to add a new A/B test: ' . implode(', ', $invalid));
		}

		return $this->post('media_files', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('media_files/%d', $itemId));
	}

	public function deleteMediaFile(int $itemId = 0) {
		return $this->delete(sprintf('media_files/%d', $itemId));
	}

	public function moveToTrash(int $itemId = 0) {
		return $this->patch(sprintf('media_files/%d/move_to_trash', $itemId));
	}

	public function restore(int $itemId = 0) {
		return $this->patch(sprintf('media_files/%d/restore', $itemId));
	}

	public function trashed() {
		return $this->get('media_files/trashed');
	}
}
