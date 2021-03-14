<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class SentCampaigns extends AbstractApi {
	public function getList() {
		return $this->get('sent_campaigns');
	}

	public function getInfo(int $itemId = 0) {
		return $this->get(sprintf('sent_campaigns/%d', $itemId));
	}

	public function cancelCampaign(int $itemId = 0) {
		return $this->patch(sprintf('sent_campaigns/%d/cancel', $itemId));
	}

	public function getClicks(int $itemId = 0) {
		return $this->get(sprintf('sent_campaigns/%d/clicks', $itemId));
	}

	public function getImpressions(int $itemId = 0) {
		return $this->get(sprintf('sent_campaigns/%d/impressions', $itemId));
	}

	public function pauseCampaign(int $itemId = 0) {
		return $this->patch(sprintf('sent_campaigns/%d/pause', $itemId));
	}

	public function resumeCampaign(int $itemId = 0) {
		return $this->patch(sprintf('sent_campaigns/%d/resume', $itemId));
	}

	public function getSentEmails(int $itemId = 0) {
		return $this->get(sprintf('sent_campaigns/%d/sent_emails', $itemId));
	}

	public function getUnsubscribeEvents(int $itemId = 0) {
		return $this->get(sprintf('sent_campaigns/%d/unsubscribe_events', $itemId));
	}
}
