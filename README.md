### About

A [Mailrelay](https://mailrelay.com) API client.

[![Build Status](https://img.shields.io/github/actions/workflow/status/AlfredoRamos/mailrelay-api-client/ci.yml?style=flat-square)](https://github.com/AlfredoRamos/mailrelay-api-client/actions)
[![Latest Stable Version](https://img.shields.io/packagist/v/alfredo-ramos/mailrelay-api-client.svg?style=flat-square&label=stable)](https://packagist.org/packages/alfredo-ramos/mailrelay-api-client)
[![Code Quality](https://img.shields.io/codacy/grade/f6603a5728ba49e5856b702d15988dee.svg?style=flat-square)](https://app.codacy.com/gh/AlfredoRamos/mailrelay-api-client/dashboard)
[![License](https://img.shields.io/packagist/l/alfredo-ramos/mailrelay-api-client.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/mailrelay-api-client/master/LICENSE)

> :warning: **While all API endpoints have been implemented, it's still under development, so it might have some bugs.**

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

|      Key      |   Type   | Required | Description                                                                                 |
| :-----------: | :------: | :------: | :------------------------------------------------------------------------------------------ |
| `api_account` | `string` |   Yes    | The account name you use to login into Mailrelay.                                           |
|  `api_token`  | `string` |   Yes    | The Mailrelay API token generated from `https://{ACCOUNT}.ipzmarketing.com/admin/api_keys`. |

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

To get the number of total pages and results per page for `list()` methods:

```php
$result = $this->client->withOptions(['full_response' => true])->api('subscribers')->list([
	'page' => 1, 'per_page' => 10
]);
$subscribers = $result->toArray();
$total = $result->totalPages();
$perPage = $result->perPage();
```

For more detailed information about Mailrelay API endpoints, please refer to the [official API documentation](https://apidocs.mailrelay.com).
