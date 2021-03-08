<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Utils;

class Str {
	static public function endsWith(string $haystack, string $needle) : bool {
		if (function_exists('str_ends_with')) {
			return str_ends_with($haystack, $needle);
		}

		$length = strlen($needle);

		if (!$length) {
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}
}
