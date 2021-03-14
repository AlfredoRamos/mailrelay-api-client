<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Utils;

class Validator {
	public function validateEmptyFields(array $data = []) {
		if (!empty($data)) {
			return;
		}

		throw new \InvalidArgumentException('Request data cannot be empty.');
	}

	public function validateRequiredFields(array $required = [], array $data = []) {
		if (empty($required)) {
			throw new \InvalidArgumentException('Invalid required field list.');
		}

		$missing = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $key => $value) {
			if (is_numeric($key) && empty($data[$value])) {
				$missing[] = $value;
			}

			if (is_string($key) && is_array($value)) {
				$mis = [];

				if (empty($data[$key])) {
					$mis = $required[$key];
				}

				foreach ($value as $item) {
					if (empty($data[$key][$item]) && !in_array($item, $mis)) {
						$mis[] = $item;
					}
				}

				if (!empty($mis)) {
					$missing[] = sprintf('%s[%s]', $key, implode(',', $mis));
				}
			}
		}

		if (!empty($missing)) {
			$message = sprintf(
				'Missing required fields: %s',
				implode(', ', $missing)
			);

			throw new \InvalidArgumentException($message);
		}
	}
}
