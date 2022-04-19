<?php

/**
 * Mailrelay API Client.
 *
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2021 Alfredo Ramos
 * @license GPL-3.0-or-later
 */

namespace AlfredoRamos\Mailrelay\Tests\Utils;

use PHPUnit\Framework\TestCase;
use AlfredoRamos\Mailrelay\Utils\Validator;

class ValidatorTest extends TestCase {
	public function testEmptyFields() {
		$this->expectException(\InvalidArgumentException::class);
		$validator = new Validator;
		$validator->validateEmptyFields([]);
	}

	public function testNonEmptyFields() {
		$validator = new Validator;
		$output = $validator->validateEmptyFields(['abc' => 'xyz']);
		$this->assertNull($output);
	}

	public function testInvalidRequiredFields() {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Invalid required field list.');
		$validator = new Validator;
		$validator->validateRequiredFields([], []);
	}

	public function testMissingRequiredFields() {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Missing required fields:');
		$validator = new Validator;
		$validator->validateRequiredFields(['field' => ['valaue']], []);
	}

	public function testArray() {
		$validator = new Validator;
		$output = $validator->validateRequiredFields(
			['subject'],
			['subject' => 'test']
		);
		$this->assertNull($output);
	}

	public function testArrayMissingFields() {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Missing required fields: subject');
		$validator = new Validator;
		$validator->validateRequiredFields(
			['subject'],
			['param' => 'value']
		);
	}

	public function testAssociativeArray() {
		$validator = new Validator;
		$output = $validator->validateRequiredFields(
			['file' => ['name']],
			['file' => ['name' => 'test.csv']]
		);
		$this->assertNull($output);
	}

	public function testAssociativeArrayMissingFields() {
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Missing required fields: file[name]');
		$validator = new Validator;
		$validator->validateRequiredFields(
			['file' => ['name']],
			['param' => ['key' => 'value']]
		);
	}
}
