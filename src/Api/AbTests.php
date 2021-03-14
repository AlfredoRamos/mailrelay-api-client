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
		return $this->request->get('ab_tests');
	}

	public function addNew(array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = [
			'campaign_id',
			'test_type',
			'percentage',
			'decide_with'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('ab_tests', ['json' => $data]);
	}

	public function getInfo(int $itemId = 0) {
		return $this->request->get(sprintf('ab_tests/%d', $itemId));
	}

	public function deleteTest(int $itemId = 0) {
		return $this->request->delete(sprintf('ab_tests/%d', $itemId));
	}

	public function cancelTest(int $itemId = 0) {
		return $this->request->patch(sprintf('ab_tests/%d/cancel', $itemId));
	}

	public function choose(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['combination'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post(
			sprintf('ab_tests/%d/choose_winning_combination', $itemId),
			['json' => $data]
		);
	}

	public function setManual(int $itemId = 0) {
		return $this->request->patch(sprintf('ab_tests/%d/set_as_manual', $itemId));
	}
}
