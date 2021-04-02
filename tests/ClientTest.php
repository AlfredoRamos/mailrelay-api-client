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
use AlfredoRamos\Mailrelay\Client;

class ClientTest extends TestCase {
	public function testInstance() {
		$client = new Client([
			'api_account' => 'xyz',
			'api_token' => 'abc'
		]);
		$this->assertInstanceOf(Client::class, $client);
	}

	public function testInvalidClient() {
		$this->expectException(\InvalidArgumentException::class);
		$client = new Client;
	}

	public function testApiClasses() {
		$endpoints = [
			'send_emails',
			'ab_tests',
			'campaigns',
			'campaign_folders',
			'custom_fields',
			'imports',
			'groups',
			'media_files',
			'media_folders',
			'rss_campaigns',
			'senders',
			'sent_campaigns',
			'smtp_emails',
			'smtp_tags',
			'subscribers',
			'unsubscribe_events',
			'package',
			'api_batches'
		];

		$client = new Client([
			'api_account' => 'xyz',
			'api_token' => 'abc'
		]);

		foreach ($endpoints as $endpoint) {
			$apiClass = $this->getApiClass($endpoint);
			$this->assertTrue(class_exists($apiClass));
			$this->assertInstanceOf($apiClass, $client->api($endpoint));
		}
	}

	public function testOptions() {
		$client = new Client([
			'api_account' => 'xyz',
			'api_token' => 'abc'
		]);

		$options = $client->getOptions();

		$this->assertTrue(is_array($options));
		$this->assertFalse(empty($options));
	}

	private function getApiClass(string $name = '') {
		$name = trim($name, " \n\r\t\v\0\/");
		$apiClass = ucwords($name, '_');
		$apiClass = str_replace('_', '', $apiClass);
		$apiClass = 'AlfredoRamos\\Mailrelay\\Api\\' . $apiClass;
		return $apiClass;
	}
}
