<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Utils;

class Sanitize {
	/**
	 * Remove reserved email headers.
	 *
	 * @param array $data Email data.
	 *
	 * @throws \InvalidArgumentException If email header list is not an array.
	 *
	 * @return array Sanitized email data.
	 */
	public function sanitizeEmailHeaders(array $data = []): array {
		if (empty($data['headers'])) {
			return $data;
		}

		if (!is_array($data['headers'])) {
			throw new \InvalidArgumentException('Invalid email header list.');
		}

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
		$regexp = '#^(?:' . implode('|', $reservedHeaders) . ')#i';

		// Remove reserved headers
		foreach ($data['headers'] as $key => $value) {
			if (!preg_match($regexp, $value)) {
				continue;
			}

			unset($data['headers'][$key]);
		}

		return $data;
	}
}
