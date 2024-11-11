<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\ResourceMetadataFactory;
use Alphpaca\Contracts\Resource\Metadata\AsResource;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;

describe('Resource Metadata Factory', function () {
    covers(ResourceMetadataFactory::class);

    it('factors a resource metadata object from an `AsResource` attribute', function () {
        $resourceAttribute = mock(AsResource::class);
        $resourceAttribute->expects('getName')->andReturn('book');

        $testSubject = new ResourceMetadataFactory();
        $result = $testSubject->createFromAttribute('\App\Book', $resourceAttribute);

        expect($result->getName())->toBe('book')
            ->and($result->getSource())->toBe('\App\Book')
            ->and($result->getSourceType())->toBe(MetadataSourceType::ATTRIBUTE)
        ;
    });
});
