<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class SmtpEmails extends AbstractApi {
	/**
	 * List SMTP emails.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('smtp_emails', ['query' => $data]);
	}

	/**
	 * Get an SMTP email by ID.
	 *
	 * @param int	$itemId Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0, array $data = []) {
		return $this->request->get(
			sprintf('smtp_emails/%d', $itemId),
			['query' => $data]
		);
	}
}
