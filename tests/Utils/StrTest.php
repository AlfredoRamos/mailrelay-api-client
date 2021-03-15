<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Tests;

use PHPUnit\Framework\TestCase;
use AlfredoRamos\Mailrelay\Utils\Str;

class StrTest extends TestCase {
	public function testEndsWith() {
		$this->assertTrue(Str::endsWith('xyz.abc', '.abc'));
		$this->assertFalse(Str::endsWith('abc.xYz', '.xyz'));
		$this->assertTrue(Str::endsWith('123', ''));
	}
}
