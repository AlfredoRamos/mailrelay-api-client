<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Pager;

class BasicPager implements PagerInterface {
	private $page;
	private $resultsPerPage;

	public function __construct($page = 0, $resultsPerPage = 10) {
		$this->setPage($page ?: 0);
		$this->resultsPerPage($resultsPerPage ?: 10);

		return $this;
	}

	public function getPage() {
		return $this->page;
	}

	public function setPage($page) {
		$this->page = $page;

		return $this;
	}

	public function getResultsPerPage() {
		return $this->resultsPerPage;
	}

	public function setResultsPerPage($resultsPerPage) {
		$this->resultsPerPage = $resultsPerPage;

		return $this;
	}
}
