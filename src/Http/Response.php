<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Http;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class Response implements ResponseInterface {
	/** @var \Psr\Http\Message\ResponseInterface */
	protected $response;

	/** @var array */
	private $allowedHeaders = ['Total', 'Per-Page'];

	/**
	 * {@inheritDoc}
	 */
	public function __construct(PsrResponseInterface $response) {
		$this->response = $response;
	}

	/**
	 * {@inheritDoc}
	 */
	public function toArray() {
		return json_decode($this->response->getBody(), true);
	}

	/**
	 * {@inheritDoc}
	 */
	public function toJson() {
		return $this->response->getBody()->getContents();
	}

	/**
	 * {@inheritDoc}
	 */
	public function getHeaders() {
		$headers = [];

		foreach ($this->allowedHeaders as $header) {
			if ($this->response->hasHeader($header)) {
				$headers[$header] = $this->response->getHeader($header);
			}
		}

		return $headers;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getHeader(string $name) {
		$allowedHeaders = array_map('preg_quote', $this->allowedHeaders);
		$regexp = '#^(?:' . implode('|', $allowedHeaders) . ')#i';

		if (preg_match($regexp, $name) && $this->response->hasHeader($name)) {
			return $this->response->getHeader($name);
		}

		return [];
	}

	/**
	 * {@inheritDoc}
	 */
	public function getStatusCode() {
		return $this->response->getStatusCode();
	}

	/**
	 * {@inheritDoc}
	 */
	public function totalPages() {
		$total = $this->getHeader('Total');

		if (empty($total)) {
			return null;
		}

		$total = (int) $total[0];
		$total = $total < 0 ? 0 : $total;

		return $total;
	}

	/**
	 * {@inheritDoc}
	 */
	public function perPage() {
		$perPage = $this->getHeader('Per-Page');

		if (empty($perPage)) {
			return null;
		}

		$perPage = (int) $perPage[0];
		$perPage = $perPage < 0 ? 0 : $perPage;

		return $perPage;
	}
}
