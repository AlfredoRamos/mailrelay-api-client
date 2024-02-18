<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Tests\Http;

use AlfredoRamos\Mailrelay\Http\Client as HttpClient;
use GuzzleHttp\ClientInterface;

class TestHttpClient extends HttpClient {
	public function __construct(array $options = [], ClientInterface $client = null) {
		parent::__construct($options);

		$this->client = $client ?: new GuzzleClient([
			'base_uri' => sprintf(
				'https://%s.ipzmarketing.com/api/v1/',
				$this->options['api_account']
			),
			'handler' => $this->stack
		]);
	}
}
