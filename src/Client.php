<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay;

use AlfredoRamos\Mailrelay\Pager\PagerInterface;
use AlfredoRamos\Mailrelay\Utils\Str;

class Client {
	private $options = [
		'api_account' => '',
		'api_token' => ''
	];

	public function __construct(array $options = []) {
		$missing = [];

		foreach ($this->options as $key => $value) {
			if (empty($options[$key])) {
				$missing[] = $key;
				continue;
			}

			if ($key === 'api_account') {
				$suffix = '.ipzmarketing.com';

				if (Str::endsWith($options[$key], $suffix)) {
					$options[$key] = str_replace($suffix, '', $options[$key]);
				}
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

	public function api(string $name = '', PagerInterface $pager = null) {
		$name = trim($name, " \n\r\t\v\0\/");
		$apiClass = ucwords($name, '_');
		$apiClass = str_replace('_', '', $apiClass);
		$apiClass = 'AlfredoRamos\\Mailrelay\\Api\\' . $apiClass;

		if (class_exists($apiClass)) {
			return new $apiClass($this, $pager);
		}

		throw new \InvalidArgumentException('The requested API method is not supported or has not been implemented: ' . $apiClass);
	}

	public function getOptions() {
		return $this->options;
	}
}
