<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;

describe('Resource Metadata', function () {
    covers(ResourceMetadata::class);

    $metadataFactoryMethod = function (
        string $name = 'app_dummy',
        string $source = '',
        MetadataSourceType $sourceType = MetadataSourceType::ATTRIBUTE,
    ): ResourceMetadata {
        return new ResourceMetadata(
            $name,
            $source,
            $sourceType,
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
});
