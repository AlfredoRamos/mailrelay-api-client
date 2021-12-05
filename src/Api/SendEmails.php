<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class SendEmails extends AbstractApi {
	/**
	 * Send email to one or more recipients.
	 *
	 * @param array $data Request parameters.
	 *
	 * @throws \InvalidArgumentException If data does not pass validation.
	 *
	 * @return array Response data.
	 */
	public function send(array $data = []): array {
		$data = $this->sanitize->sanitizeEmailHeaders($data);
		$this->validator->validateEmptyFields($data);
		$required = [
			'from' => ['email'],
			'to' => ['email'],
			'subject'
		];
		$this->validator->validateRequiredFields($required, $data);

		return $this->request->post('send_emails', ['json' => $data]);
	}
}
