<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class SignupForms extends AbstractApi {
	/**
	 * Lists signup forms.
	 *
	 * @param array $data Request paramenters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []) {
		return $this->request->get('signup_forms', ['query' => $data]);
	}
}
