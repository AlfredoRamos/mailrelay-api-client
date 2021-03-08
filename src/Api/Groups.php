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
		return $this->get('groups');
	}

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new group.');
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
			throw new \InvalidArgumentException('Missing required data to add a new group: ' . implode(', ', $invalid));
		}

		return $this->post('groups', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('groups/%d', $itemId));
	}

	public function deleteGroup(int $itemId = 0) {
		return $this->delete(sprintf('groups/%d', $itemId));
	}

	public function updateGroup(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to update group.');
		}

		return $this->patch(
			sprintf('groups/%d', $itemId),
			['json' => $data]
		);
	}
}
