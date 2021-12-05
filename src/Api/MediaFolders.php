<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class MediaFolders extends AbstractApi {
	/**
	 * List media folders.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []): array {
		return $this->request->get('media_folders', ['query' => $data]);
	}

	/**
	 * Add a new media folder.
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

		return $this->request->post('media_folders', ['json' => $data]);
	}

	/**
	 * Get a media folder by ID.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0): array {
		return $this->request->get(sprintf('media_folders/%d', $itemId));
	}

	/**
	 * Remove a media folder.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function delete(int $itemId = 0): array {
		return $this->request->delete(sprintf('media_folders/%d', $itemId));
	}

	/**
	 * Update a media folder.
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
			sprintf('media_folders/%d', $itemId),
			['json' => $data]
		);
	}
}
