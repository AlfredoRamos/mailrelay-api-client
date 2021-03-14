<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class SendEmails extends AbstractApi {
	public function send(array $data = []) {
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
