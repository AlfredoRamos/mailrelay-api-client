<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

use AlfredoRamos\Mailrelay\Client;
use AlfredoRamos\Mailrelay\Http\Request;
use AlfredoRamos\Mailrelay\Utils\Validator;
use AlfredoRamos\Mailrelay\Utils\Sanitize;

abstract class AbstractApi {
	/** @var \AlfredoRamos\Mailrelay\Http\Request */
	protected $request;

	/** @var \AlfredoRamos\Mailrelay\Utils\Validator */
	protected $validator;

	/** @var \AlfredoRamos\Mailrelay\Utils\Sanitize */
	protected $sanitize;

	/**
	 * Abstract API constructor.
	 *
	 * @param \AlfredoRamos\Mailrelay\Client $client The Mailrelay client.
	 *
	 * @return void
	 */
	public function __construct(Client $client) {
		if (empty($this->request)) {
			$this->request = new Request($client->getOptions());
		}

		if (empty($this->validator)) {
			$this->validator = new Validator;
		}

		if (empty($this->sanitize)) {
			$this->sanitize = new Sanitize;
		}
	}
}
