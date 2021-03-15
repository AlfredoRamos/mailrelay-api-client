<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class MediaFiles extends AbstractApi {
	/**
	 * List media files.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('media_files', ['query' => $data]);
	}

	/**
	 * Add a new media file.
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
			'file' => ['name', 'content']
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('media_files', ['json' => $data]);
	}

	/**
	 * Get a single media file.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0) {
		return $this->request->get(sprintf('media_files/%d', $itemId));
	}

	/**
	 * Hard delete a media file.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function delete(int $itemId = 0) {
		return $this->request->delete(sprintf('media_files/%d', $itemId));
	}

	/**
	 * Move media file to trash.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function trash(int $itemId = 0) {
		return $this->request->patch(sprintf('media_files/%d/move_to_trash', $itemId));
	}

	/**
	 * Restore a file that is in trash.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function restore(int $itemId = 0) {
		return $this->request->patch(sprintf('media_files/%d/restore', $itemId));
	}

	/**
	 * List media files in trash.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function trashed(array $data = []) {
		return $this->request->get('media_files/trashed', ['query' => $data]);
	}
}
