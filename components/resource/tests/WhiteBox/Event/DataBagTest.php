<?php

use Alphpaca\Component\Resource\Event\DataBag;

describe('Data Bag', function () {
	covers(DataBag::class);

	it('sets and gets data', function () {
		$dataBag = new DataBag();

		$dataBag->add('foo', 'bar');

		expect($dataBag->get('foo'))->toBe('bar');
	});

	it('returns a default value if key does not exist', function () {
		$dataBag = new DataBag();

		expect($dataBag->get('foo', 'bar'))->toBe('bar');
	});

	it('allows to construct a bag with initial data', function () {
		$dataBag = new DataBag([
			'foo' => 'bar',
		]);

		expect($dataBag->get('foo'))->toBe('bar');
	});

	it('returns whether a given key exists', function () {
		$dataBag = new DataBag([
			'foo' => 'bar',
		]);

		expect($dataBag->has('foo'))->toBeTrue()
			->and($dataBag->has('bar'))->toBeFalse();
	});
});
