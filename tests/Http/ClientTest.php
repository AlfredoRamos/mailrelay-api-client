<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Tests\Http;

use PHPUnit\Framework\TestCase;
use AlfredoRamos\Mailrelay\Tests\Http\TestHttpClient as HttpClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class ClientTest extends TestCase {
	public function testGetRequest() {
		$options = [
			'api_account' => 'test_account',
			'api_token' => 'invalid_token'
		];
		$headers = ['Content-Type' => 'application/json'];
		$data = [
			'usage' => 0,
			'limit' => 0,
			'subscribers_usage' => 0,
			'subscribers_limit' => 0,
			'period_start_date' => '1970-01-01T00:00:00.000Z',
			'billing_type' => 'monthly',
			'package_type' => 'standard'
		];

		$mock = new MockHandler([
			new Response(200, $headers, json_encode($data))
		]);

		$handler = HandlerStack::create($mock);
		$client = new GuzzleClient(['handler' => $handler]);
		$httpClient = new HttpClient($options, $client);
		$response = $httpClient->get('/path', ['param' => 'value']);
		$result = $httpClient->parseResponse($response);

		$this->assertSame($data, $result);
	}

	public function testPostRequest() {
		$options = [
			'api_account' => 'test_account',
			'api_token' => 'invalid_token'
		];
		$headers = ['Content-Type' => 'application/json'];
		$data = [
			[
				'id' => 0,
				'subscriber_id' => 0,
				'email' => 'user@example.org',
				'created_at' => '1970-01-01T00:00:00.000Z'
			]
		];

		$mock = new MockHandler([
			new Response(200, $headers, json_encode($data))
		]);

		$handler = HandlerStack::create($mock);
		$client = new GuzzleClient(['handler' => $handler]);
		$httpClient = new HttpClient($options, $client);
		$response = $httpClient->post('/path', ['param' => 'value']);
		$result = $httpClient->parseResponse($response);

		$this->assertSame($data, $result);
	}

	public function testPatchtRequest() {
		$options = [
			'api_account' => 'test_account',
			'api_token' => 'invalid_token'
		];
		$headers = ['Content-Type' => 'application/json'];
		$data = [
			'id' => 0,
			'subject' => 'string',
			'sender_id' => 0,
			'campaign_folder_id' => 0,
			'target' => 'groups',
			'segment_id' => 0,
			'group_ids' => 'string',
			'preview_text' => 'string',
			'html' => 'string',
			'editor_type' => 'html',
			'url_token' => false,
			'analytics_utm_campaign' => 'string',
			'use_premailer' => false
		];

		$mock = new MockHandler([
			new Response(200, $headers, json_encode($data))
		]);

		$handler = HandlerStack::create($mock);
		$client = new GuzzleClient(['handler' => $handler]);
		$httpClient = new HttpClient($options, $client);
		$response = $httpClient->patch('/path', ['param' => 'value']);
		$result = $httpClient->parseResponse($response);

		$this->assertSame($data, $result);
	}

	public function testDeleteRequest() {
		$options = [
			'api_account' => 'test_account',
			'api_token' => 'invalid_token'
		];

		$mock = new MockHandler([
			new Response(204)
		]);

		$handler = HandlerStack::create($mock);
		$client = new GuzzleClient(['handler' => $handler]);
		$httpClient = new HttpClient($options, $client);
		$response = $httpClient->delete('/path', ['param' => 'value']);

		$this->assertSame(204, $response->getStatusCode());
	}
}
