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
		return $this->get('custom_fields');
	}

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new custom field.');
		}

		$required = [
			'label',
			'tag_name',
			'field_type'
		];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to add a new custom field: ' . implode(', ', $invalid));
		}

		return $this->post('custom_fields', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('custom_fields/%d', $itemId));
	}

	public function deleteCustomField(int $itemId = 0) {
		return $this->delete(sprintf('custom_fields/%d', $itemId));
	}

	public function updateCustomField(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to update custom field.');
		}

		return $this->patch(
			sprintf('custom_fields/%d', $itemId),
			['json' => $data]
		);
	}
}
