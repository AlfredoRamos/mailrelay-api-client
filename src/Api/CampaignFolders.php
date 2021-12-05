<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class CampaignFolders extends AbstractApi {
	/**
	 * List campaign folders.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []): array {
		return $this->request->get('campaign_folders', ['query' => $data]);
	}

	/**
	 * Add a new campaign folder.
	 *
	 * @param array $data Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function add(array $data = []): array {
		$this->validator->validateEmptyFields($data);
		$required = ['name'];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('campaign_folders', ['json' => $data]);
	}

	/**
	 * Get a campaign folder by ID.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0): array {
		return $this->request->get(sprintf('campaign_folders/%d', $itemId));
	}

	/**
	 * Remove a campaign folder.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function delete(int $itemId = 0): array {
		return $this->request->delete(sprintf('campaign_folders/%d', $itemId));
	}

	/**
	 * Update a campaign folder.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function update(int $itemId = 0, array $data = []): array {
		$this->validator->validateEmptyFields($data);

		return $this->request->patch(
			sprintf('campaign_folders/%d', $itemId),
			['json' => $data]
		);
	}
}
