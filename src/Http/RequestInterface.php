<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

interface RequestInterface {
	public function get(string $url = '', array $parameters = []);

	public function post(string $url = '', array $parameters = []);

	public function patch(string $url = '', array $parameters = []);

	public function delete(string $url = '', array $parameters = []);
}
