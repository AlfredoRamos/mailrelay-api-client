<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Tests\Api;

use PHPUnit\Framework\TestCase;
use AlfredoRamos\Mailrelay\Client;
use AlfredoRamos\Mailrelay\Http\Request;
use AlfredoRamos\Mailrelay\Utils\Validator;
use AlfredoRamos\Mailrelay\Utils\Sanitize;

class AbstractApiTest extends TestCase {
	public function testHelperInstances() {
		$client = new Client([
			'api_account' => 'xyz',
			'api_token' => 'abc'
		]);
		$this->assertInstanceOf(Client::class, $client);

		$abstractApi = new TestAbstractApi($client);
		$this->assertInstanceOf(Request::class, $abstractApi->getRequest());
		$this->assertInstanceOf(Validator::class, $abstractApi->getValidator());
		$this->assertInstanceOf(Sanitize::class, $abstractApi->getSanitize());
	}
}
