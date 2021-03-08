<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Pager;

interface PagerInterface {
	public function getPage();

	public function setPage($page);

	public function getResultsPerPage();

	public function setResultsPerPage($resultsPerPage);
}
