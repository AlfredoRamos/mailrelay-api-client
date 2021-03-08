<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay;

use AlfredoRamos\Mailrelay\Http\Client as HttpClient;
use AlfredoRamos\Mailrelay\Utils\Str;

class Client {
	private $options = [
		'api_account' => '',
		'api_token' => ''
	];

	private $httpClient;

	public function __construct(array $options = []) {
		foreach ($options as $key => $value) {
			if (!array_key_exists($key, $this->options) || empty($value)) {
				continue;
			}

			if ($key === 'api_account') {
				$suffix = '.ipzmarketing.com';

				if (Str::endsWith($value, $suffix)) {
					str_replace($suffix, '', $value);
				}
			}

			$this->options[$key] = $value;
		}

		if (empty($this->options['api_account'])) {
			throw new \InvalidArgumentException('You need to provide a Mailrelay API account.');
		}

		if (empty($this->options['api_token'])) {
			throw new \InvalidArgumentException('You need to provide a Mailrelay API token.');
		}
	}

	public function api(string $name = '') {
		$apiClass = ucwords($name, '_');
		$apiClass = str_replace('_', '', $apiClass);
		$apiClass = 'AlfredoRamos\\Mailrelay\\Api\\' . $apiClass;

		if (class_exists($apiClass)) {
			return new $apiClass($this);
		}

		throw new \InvalidArgumentException('The requested API method is not supported or has not been implemented: ' . $apiClass);
	}

	public function getHttpClient() {
		if (!isset($this->httpClient)) {
			$this->httpClient = new HttpClient($this->options);
		}

		return $this->httpClient;
	}
}
