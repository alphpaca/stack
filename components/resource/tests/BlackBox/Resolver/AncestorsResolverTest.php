<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Resolver\AncestorsResolver;
use Alphpaca\Contracts\Resource\Resolver\Exception\ResolvingException;
use Tests\Alphpaca\Component\Resource\BlackBox\Resolver\DataFixtures\ChildBook;
use Tests\Alphpaca\Component\Resource\BlackBox\Resolver\DataFixtures\GrandparentBook;
use Tests\Alphpaca\Component\Resource\BlackBox\Resolver\DataFixtures\ParentBook;

describe('Ancestors Resolver', function () {
	covers(AncestorsResolver::class);

	$resolver = new AncestorsResolver();

	it('returns ancestors for a given class', function () use ($resolver) {
		$result = $resolver->resolve(ChildBook::class);

		expect($result)->toBe([
			GrandparentBook::class => GrandparentBook::class,
			ParentBook::class => ParentBook::class,
		]);
	});

	it('throws an exception if a given class does not exist', function () use ($resolver) {
		$resolver->resolve('\Foo');
	})->throws(ResolvingException::class, 'Could not resolve ancestors for class "\Foo".');
});
