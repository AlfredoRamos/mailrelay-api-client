<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Utils;

class Sanitize {
	public function sanitizeEmailHeaders(array $data = []) {
		if (empty($data['headers'])) {
			return;
		}

		$headers = $data['headers'];

		if (!is_array($headers)) {
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
		$regexp = '#' . implode('|', $reservedHeaders) . '#i';

		// Remove reserved headers
		foreach ($headers as $key => $value) {
			if (!preg_match($regexp, $value)) {
				continue;
			}

			unset($headers[$key]);
		}

		return $headers;
	}
}
