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
	/**
	 * Check if string ends with given substring.
	 *
	 * @param string $haystack	The string to search in.
	 * @param string $needle	The substring to search for.
	 *
	 * @return bool Whether string ends with substring.
	 */
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
