<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Metadata\ResourceMetadataFactory;
use Alphpaca\Contracts\Resource\Metadata\AsResource;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;

describe('Resource Metadata Factory', function () {
	covers(ResourceMetadataFactory::class);

	it('factors a resource metadata object from an `AsResource` attribute', function () {
		$resourceAttribute = new AsResource(name: 'book', priority: 10);

		$testSubject = new ResourceMetadataFactory();
		$result = $testSubject->createFromAttribute('\App\Book', $resourceAttribute);

		expect($result->getName())->toBe('book')
			->and($result->getSource())->toBe('\App\Book')
			->and($result->getSourceType())->toBe(MetadataSourceType::ATTRIBUTE)
			->and($result->getPriority())->toBe(10);
	});
});
