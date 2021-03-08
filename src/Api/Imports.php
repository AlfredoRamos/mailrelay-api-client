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
		return $this->get('imports');
	}

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data for email sending.');
		}

		$required = [
			'file' => ['name', 'content'],
			'import_fields_attributes' => ['column', 'field']
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
			throw new \InvalidArgumentException('Missing required data to add a new import: ' . implode(', ', $invalid));
		}

		return $this->post('imports', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('imports/%d', $itemId));
	}

	public function cancelImport(int $itemId = 0) {
		return $this->patch(sprintf('imports/%d/cancel', $itemId));
	}

	public function getContents(int $itemId = 0) {
		return $this->get(sprintf('imports/%d/data', $itemId));
	}
}
