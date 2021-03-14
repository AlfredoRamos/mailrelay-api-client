<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

interface ClientInterface {
	public function sendRequest(string $url = '', array $parameters = [], $method = 'GET');

	public function parseResponse($response);
}
