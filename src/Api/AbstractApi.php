<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

use AlfredoRamos\Mailrelay\Client;
use AlfredoRamos\Mailrelay\Http\Request;

abstract class AbstractApi {
	protected $request;

	public function __construct(Client $client, PagerInterface $pager = null) {
		if (empty($this->request)) {
			$this->request = new Request(
				$client->getOptions(),
				$pager
			);
		}
	}
}
