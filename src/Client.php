<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay;

class Client {
	/** @var array */
	private $options = [
		'api_account' => '',
		'api_token' => ''
	];

	/**
	 * Mailrelay client constructor.
	 *
	 * @param array $options Configuration options.
	 *
	 * @throws \InvalidArgumentException If configuration options is missing API data.
	 *
	 * @return void
	 */
	public function __construct(array $options = []) {
		$missing = [];

		foreach (array_keys($this->options) as $key) {
			if (!is_string($key)) {
				continue;
			}

			if (empty($options[$key])) {
				$missing[] = $key;
				continue;
			}

			if ($key === 'api_account') {
				$options[$key] = str_replace('.ipzmarketing.com', '', $options[$key]);
			}

			if (empty($options[$key])) {
				$missing[] = $key;
				continue;
			}

			$this->options[$key] = $options[$key];
		}

		if (!empty($missing)) {
			throw new \InvalidArgumentException('Missing Mailrelay API data: ' . implode(', ', $missing));
		}
	}

	/**
	 * Get class by given API endpoint.
	 *
	 * @param string $name API endpoint name.
	 *
	 * @throws \InvalidArgumentException If API endpoint class does not exist.
	 *
	 * @return mixed API endpoint class.
	 */
	public function api(string $name = '') {
		$name = trim($name, " \n\r\t\v\0\/");
		$apiClass = ucwords($name, '_');
		$apiClass = str_replace('_', '', $apiClass);
		$apiClass = 'AlfredoRamos\\Mailrelay\\Api\\' . $apiClass;

		if (class_exists($apiClass)) {
			return new $apiClass($this);
		}

		throw new \InvalidArgumentException('The requested API method is not supported or has not been implemented: ' . $apiClass);
	}

	/**
	 * Get configuration options.
	 *
	 * @return array Configuration options.
	 */
	public function getOptions() {
		return $this->options;
	}
}
