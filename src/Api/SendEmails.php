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
		if (!is_array($data)) {
			throw new \InvalidArgumentException('Invalid data for email sending.');
		}

		$required = [
			'from' => 'email',
			'to' => 'email',
			'subject'
		];
		$invalid = [];

		// TODO: Handle multiple empty emails in the 'to' array
		foreach ($required as $key => $value) {
			if (is_numeric($key) && empty($data[$value])) {
				$invalid[] = $value;
			}

			if (is_string($key) && (empty($data[$key]) || empty($data[$value]))) {
				$invalid[] = sprintf('%s[%s]', $key, $value);
			}
		}

		if (!empty($invalid)) {
			throw new \InvalidArgumentException('Missing required data for email sending: ' . implode(', ', $invalid));
		}

		if (is_array($data['headers']) && !empty($data['headers'])) {
			$reservedHeaders = [
				'Authentication-Results',
				'Bcc',
				'Cc',
				'DKIM-Signature',
				'Date',
				'Delivered-To',
				'DomainKey-Status',
				'From',
				'List-Id',
				'List-Unsubscribe',
				'List-Unsubscribe-POST',
				'Received',
				'Received-SPF',
				'Return-Path',
				'Sender',
				'Subject',
				'To',
				'User-Agent'
			];

			$reservedHeaders = array_map('preg_quote', $reservedHeaders);
			$regexp = '#' . implode('|', $reservedHeaders) . '#i';

			// Remove reserved headers
			foreach ($data['headers'] as $key => $value) {
				if (!preg_match($regexp, $value)) {
					continue;
				}

				unset($data['headers'][$key]);
			}
		}

		return $this->request->post('send_emails', ['json' => $data]);
	}
}
