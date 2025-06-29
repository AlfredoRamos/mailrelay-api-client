<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class AbTests extends AbstractApi {
	/**
	 * List A/B tests.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('ab_tests', ['query' => $data]);
	}

	/**
	 * Add a new A/B test.
	 *
	 * @param array $data Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function add(array $data = []) {
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

	/**
	 * Get an A/B test by ID.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0) {
		return $this->request->get(sprintf('ab_tests/%d', $itemId));
	}

	/**
	 * Remove an A/B test.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function delete(int $itemId = 0) {
		return $this->request->delete(sprintf('ab_tests/%d', $itemId));
	}

	/**
	 * Cancel A/B test.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function cancel(int $itemId = 0) {
		return $this->request->patch(sprintf('ab_tests/%d/cancel', $itemId));
	}

	/**
	 * Choose which A/B test combination should to be sent to the remaining subscribers.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function choose(int $itemId = 0, array $data = []) {
		$this->validator->validateEmptyFields($data);
		$required = ['combination'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post(
			sprintf('ab_tests/%d/choose_winning_combination', $itemId),
			['json' => $data]
		);
	}

	/**
	 * Set A/B test as manual
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function manual(int $itemId = 0) {
		return $this->request->patch(sprintf('ab_tests/%d/set_as_manual', $itemId));
	}
}
