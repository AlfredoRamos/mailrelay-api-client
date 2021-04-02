### About

A [Mailrelay](https://mailrelay.com) API client.

> :warning: **While all API endpoints have been implemented, it's still under development, so it might have some bugs.** :warning:

### Requirements

- PHP 7.2.5 or greater

### Installation

Open your `composer.json` file and add the package in the `require` object:

```json
"alfredo-ramos/mailrelay-api-client": "^0.1.0"
```

Then run `composer update` on your terminal.

### Usage

The constructor takes an `array` with the API data needed to connect with your Mailrelay account.

```php
require __DIR__ . '/vendor/autoload.php';

$mailrelay = new AlfredoRamos\Mailrelay\Client([
	'api_account' => 'mailrelay_account',
	'api_token' => 'mailrelay_api_token'
]);
```

Key | Type | Required | Description
:-: | :-: | :-: | :-
`api_account` | `string` | Yes | The account name you use to login into Mailrelay.
`api_token` | `string` | Yes | The Mailrelay API token generated from `https://{ACCOUNT}.ipzmarketing.com/admin/api_keys`.

You can access each endpoint using the `AlfredoRamos\Mailrelay\Client::api()` method.

```php
// Create or update a subscriber
$mailrelay->api('subscribers')->sync([
	'status' => 'active',
	'email' => 'user@example.org',
	'group_ids' => [1]
]);

// Get account package info
$mailrelay->api('package')->info();
```

For more detailed information about Mailrelay API endpoints, please refer to the [official API documentation](https://account.ipzmarketing.com/api-documentation/).
