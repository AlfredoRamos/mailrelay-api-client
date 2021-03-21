<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Tests\Middleware;

use PHPUnit\Framework\TestCase;
use AlfredoRamos\Mailrelay\Middleware\Error as ErrorMiddleware;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class ErrorTest extends TestCase {
	public function testSuccessfulResponse() {
		$mock = new MockHandler([
			new Response(200)
		]);

		$stack = new HandlerStack($mock);
		$stack->push(ErrorMiddleware::error());

		$handler = $stack->resolve();
		$request = new Request('GET', 'https://example.org/?param=value');
		$promise = $handler($request, []);
		$response = $promise->wait();

		$this->assertSame(200, $response->getStatusCode());
	}

	public function testInvalidRequestResponse() {
		$this->expectException(\ErrorException::class);
		$this->expectExceptionMessage('[400] Mailrelay API request failed: The request is invalid. Check if the field names in the request and the request data is valid.');

		$mock = new MockHandler([
			new Response(400, [], json_encode(
				['error' => 'The request is invalid. Check if the field names in the request and the request data is valid.']
			))
		]);

		$stack = new HandlerStack($mock);
		$stack->push(ErrorMiddleware::error());

		$handler = $stack->resolve();
		$request = new Request('GET', 'https://example.org/?param=value');
		$promise = $handler($request, []);
		$response = $promise->wait();

		$this->assertSame(400, $response->getStatusCode());
	}

	public function testUnauthorizedResponse() {
		$this->expectException(\ErrorException::class);
		$this->expectExceptionMessage('[401] Mailrelay API request failed: You need to provide an authentication token.');

		$mock = new MockHandler([
			new Response(401, [], json_encode(
				['error' => 'You need to provide an authentication token.']
			))
		]);

		$stack = new HandlerStack($mock);
		$stack->push(ErrorMiddleware::error());

		$handler = $stack->resolve();
		$request = new Request('GET', 'https://example.org/?param=value');
		$promise = $handler($request, []);
		$response = $promise->wait();

		$this->assertSame(401, $response->getStatusCode());
	}

	public function testNotFoundResponse() {
		$this->expectException(\ErrorException::class);
		$this->expectExceptionMessage('[404] Mailrelay API request failed: Couldn\'t find record with provided ID.');

		$mock = new MockHandler([
			new Response(404, [], json_encode(
				['error' => 'Couldn\'t find record with provided ID.']
			))
		]);

		$stack = new HandlerStack($mock);
		$stack->push(ErrorMiddleware::error());

		$handler = $stack->resolve();
		$request = new Request('GET', 'https://example.org/?param=value');
		$promise = $handler($request, []);
		$response = $promise->wait();

		$this->assertSame(404, $response->getStatusCode());
	}

	public function testValidationErrorResponse() {
		$this->expectException(\ErrorException::class);
		$this->expectExceptionMessage('[422] Mailrelay API request failed: A validation error occurred. Check the response body for more information.');

		$mock = new MockHandler([
			new Response(422, [], json_encode(
				['error' => 'A validation error occurred. Check the response body for more information.']
			))
		]);

		$stack = new HandlerStack($mock);
		$stack->push(ErrorMiddleware::error());

		$handler = $stack->resolve();
		$request = new Request('GET', 'https://example.org/?param=value');
		$promise = $handler($request, []);
		$response = $promise->wait();

		$this->assertSame(422, $response->getStatusCode());
	}

	public function testServerErrorResponse() {
		$this->expectException(\ErrorException::class);
		$this->expectExceptionMessage('[500] Mailrelay API request failed: An internal error happened. Try again later.');

		$mock = new MockHandler([
			new Response(500, [], json_encode(
				['error' => 'An internal error happened. Try again later.']
			))
		]);

		$stack = new HandlerStack($mock);
		$stack->push(ErrorMiddleware::error());

		$handler = $stack->resolve();
		$request = new Request('GET', 'https://example.org/?param=value');
		$promise = $handler($request, []);
		$response = $promise->wait();

		$this->assertSame(500, $response->getStatusCode());
	}
}
