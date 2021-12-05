<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2021 Alfredo Ramos (https://alfredoramos.mx)
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Api;

class SentCampaigns extends AbstractApi {
	/**
	 * List sent campaigns.
	 *
	 * @param array $data Request parameters.
	 *
	 * @return array Response data.
	 */
	public function list(array $data = []): array {
		return $this->request->get('sent_campaigns', ['query' => $data]);
	}

	/**
	 * Get a single sent campaign.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function get(int $itemId = 0): array {
		return $this->request->get(sprintf('sent_campaigns/%d', $itemId));
	}

	/**
	 * Cancel a campaign.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function cancel(int $itemId = 0): array {
		return $this->request->patch(sprintf('sent_campaigns/%d/cancel', $itemId));
	}

	/**
	 * Get sent campaign's clicks.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @return array Response data.
	 */
	public function clicks(int $itemId = 0, array $data = []): array {
		return $this->request->get(
			sprintf('sent_campaigns/%d/clicks', $itemId),
			['query' => $data]
		);
	}

	/**
	 * Get sent campaign's impressions.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @return array Response data.
	 */
	public function impressions(int $itemId = 0, array $data = []): array {
		return $this->request->get(
			sprintf('sent_campaigns/%d/impressions', $itemId),
			['query' => $data]
		);
	}

	/**
	 * Pause a campaign that is being sent.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function pause(int $itemId = 0): array {
		return $this->request->patch(sprintf('sent_campaigns/%d/pause', $itemId));
	}

	/**
	 * Resume a campaign that is paused.
	 *
	 * @param int $itemId Item ID.
	 *
	 * @return array Response data.
	 */
	public function resume(int $itemId = 0): array {
		return $this->request->patch(sprintf('sent_campaigns/%d/resume', $itemId));
	}

	/**
	 * Get sent campaign's sent emails.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @return array Response data.
	 */
	public function emails(int $itemId = 0, array $data = []): array {
		return $this->request->get(
			sprintf('sent_campaigns/%d/sent_emails', $itemId),
			['query' => $data]
		);
	}

	/**
	 * Get sent campaign's impressions.
	 *
	 * @param int	$itemId	Item ID.
	 * @param array	$data	Request parameters.
	 *
	 * @return array Response data.
	 */
	public function unsubscribeEvents(int $itemId = 0, array $data = []): array {
		return $this->request->get(
			sprintf('sent_campaigns/%d/unsubscribe_events', $itemId),
			['query' => $data]
		);
	}
}
