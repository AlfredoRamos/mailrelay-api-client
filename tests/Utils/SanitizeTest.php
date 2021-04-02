<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Tests\Utils;

use PHPUnit\Framework\TestCase;
use AlfredoRamos\Mailrelay\Utils\Sanitize;

class SanitizeTest extends TestCase {
	public function testEmailHeaders() {
		$sanitize = new Sanitize;
		$data = [
			'headers' => [
				'BCC',
				'cc',
				'fRoM',
				'Custom-Header'
			]
		];

		$this->assertContains('fRoM', $data['headers']);

		$data = $sanitize->sanitizeEmailHeaders($data);

		$this->assertNotContains('fRoM', $data['headers']);

		$this->assertContains('Custom-Header', $data['headers']);
	}

	public function testMissingEmailHeaders() {
		$sanitize = new Sanitize;
		$data = ['param' => 'value'];

		$this->assertSame($data, $sanitize->sanitizeEmailHeaders($data));
	}

	public function testInvalidEmailHeaders() {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Invalid email header list.');
		$sanitize = new Sanitize;
		$data = ['headers' => true];
		$sanitize->sanitizeEmailHeaders($data);
	}
}
