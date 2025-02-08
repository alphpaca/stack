<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;

describe('Resource Metadata', function () {
    covers(ResourceMetadata::class);

    $metadataFactoryMethod = function (
        string $name = 'app_dummy',
        string $source = '',
        MetadataSourceType $sourceType = MetadataSourceType::ATTRIBUTE,
        string $class = '\App\Resource\Dummy',
    ): ResourceMetadata {
        return new ResourceMetadata(
            $name,
            $source,
            $sourceType,
            $class,
        );
    };

    it('returns its name', function () use ($metadataFactoryMethod) {
        $metadata = $metadataFactoryMethod(name: 'alphpaca_book');

        expect($metadata->getName())->toBe('alphpaca_book');
    });

    it('returns its source', function () use ($metadataFactoryMethod) {
        $metadata = $metadataFactoryMethod(source: '\App\Book');

        expect($metadata->getSource())->toBe('\App\Book');
    });

    it('returns its source type', function () use ($metadataFactoryMethod) {
        $metadata = $metadataFactoryMethod(sourceType: MetadataSourceType::ATTRIBUTE);

        expect($metadata->getSourceType())->toBe(MetadataSourceType::ATTRIBUTE);
    });

    it('returns its class name', function () use ($metadataFactoryMethod) {
        $metadata = $metadataFactoryMethod(class: '\App\Resource\Book');

        expect($metadata->getClass())->toBe('\App\Resource\Book');
    });

    it('returns its priority', function () use ($metadataFactoryMethod) {
        $metadata = $metadataFactoryMethod();

        expect($metadata->getPriority())->toBe(0);
    });
});
