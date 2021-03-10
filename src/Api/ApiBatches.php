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
		return $this->get('api_batches');
	}

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new API batch.');
		}

		$required = [
			'operations_attributes' => ['request_method', 'request_path']
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
			throw new \InvalidArgumentException('Missing required data to add a new API batch: ' . implode(', ', $invalid));
		}

		return $this->post('api_batches', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('api_batches/%d', $itemId));
	}
}
