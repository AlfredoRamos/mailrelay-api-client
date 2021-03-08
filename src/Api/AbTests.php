<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class AbTests extends AbstractApi {
	public function getList() {
		return $this->get('ab_tests');
	}

	public function addNew($data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to add a new A/B test.');
		}

		$required = [
			'campaign_id',
			'test_type',
			'percentage',
			'decide_with'
		];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to add a new A/B test: ' . implode(', ', $invalid));
		}

		return $this->post('ab_tests', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('ab_tests/%d', $itemId));
	}

	public function deleteTest(int $itemId = 0) {
		return $this->delete(sprintf('ab_tests/%d', $itemId));
	}

	public function cancelTest(int $itemId = 0) {
		return $this->patch(sprintf('ab_tests/%d/cancel', $itemId));
	}

	public function choose(int $itemId = 0, $data = []) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data to choose A/B test winning combination.');
		}

		$required = ['combination'];
		$invalid = [];

		// TODO: Validate allowed values of required fields
		foreach ($required as $item) {
			if (empty($data[$item])) {
				$invalid[] = $item;
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data to choose A/B test winning combination: ' . implode(', ', $invalid));
		}

		return $this->post(
			sprintf('ab_tests/%d/choose_winning_combination', $itemId),
			['json' => $data]
		);
	}

	public function setManual(int $itemId = 0) {
		return $this->patch(sprintf('ab_tests/%d/set_as_manual', $itemId));
	}
}
