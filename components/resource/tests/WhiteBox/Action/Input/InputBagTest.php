<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Action\Input\InputBag;

describe('Input Bag', function () {
	it('stores values', function () {
		$inputBag = new InputBag();

		$inputBag->add('foo', 'bar');

		expect($inputBag->get('foo'))->toBe('bar');
	});

	it('retrieves values', function () {
		$inputBag = new InputBag([
			'foo' => 'bar',
		]);

		expect($inputBag->get('foo'))->toBe('bar');
	});

	it('fallbacks to default values when key is not found', function () {
		$inputBag = new InputBag();

		expect($inputBag->get('foo', 'bar'))->toBe('bar');
	});

	it('returns whether a key exists', function () {
		$inputBag = new InputBag(['foo' => 'bar']);

		expect($inputBag->has('foo'))->toBeTrue()
			->and($inputBag->has('bar'))->toBeFalse();
	});
});
