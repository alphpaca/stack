<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Factory\ObjectFactory;
use Alphpaca\Contracts\Resource\Factory\Exception\ObjectCannotBeFactoredException;
use Tests\Alphpaca\Component\Resource\WhiteBox\Factory\DataFixtures\Book;

describe('Object Factory', function () {
	covers(ObjectFactory::class);

	it('instantiates a given class with provided parameters', function () {
		$testSubject = new ObjectFactory();
		$result = $testSubject->create(Book::class, title: 'Winnie The Pooh');

		expect($result->getTitle())->toBe('Winnie The Pooh');
	});

	it('throws an exception if a given class does not exist', function () {
		$testSubject = new ObjectFactory();
		$testSubject->create('Foo');
	})->throws(ObjectCannotBeFactoredException::class, 'Class "Foo" does not exist, so cannot be instantiated.');
});
