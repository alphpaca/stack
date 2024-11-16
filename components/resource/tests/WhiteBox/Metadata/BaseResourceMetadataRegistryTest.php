<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\BaseResourceMetadataRegistry;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataExtension;

describe('Base Resource Metadata Registry', function () {
    covers(BaseResourceMetadataRegistry::class);

    it('adds a resource extension to registry', function () {
        $dummyExtension = mock(ResourceMetadataExtension::class);
        $zummyExtension = mock(ResourceMetadataExtension::class);

        $registry = new BaseResourceMetadataRegistry();
        $registry->addExtension($dummyExtension);
        $registry->addExtension($zummyExtension);

        expect($registry->getExtensions())->toBe([$dummyExtension, $zummyExtension]);
    });

    it('prevents duplicate extensions', function () {
        $dummyExtension = mock(ResourceMetadataExtension::class);

        $registry = new BaseResourceMetadataRegistry();
        $registry->addExtension($dummyExtension);
        $registry->addExtension($dummyExtension);

        expect($registry->getExtensions())->toBe([$dummyExtension]);
    });

    it('invokes all registered extensions on added resource metadata', function () {
        $dummyResource = mock(ResourceMetadata::class);
        $dummyResource->expects('getName')->once()->andReturns('app_dummy');

        $dummyExtension = mock(ResourceMetadataExtension::class);
        $dummyExtension->expects('extend')->once()->with($dummyResource);

        $zummyExtension = mock(ResourceMetadataExtension::class);
        $zummyExtension->expects('extend')->once()->with($dummyResource);

        $registry = new BaseResourceMetadataRegistry();
        $registry->addExtension($dummyExtension);
        $registry->addExtension($zummyExtension);
        $registry->addMetadata($dummyResource);
    });

    it('returns a resource metadata for a given resource name', function () {
        $dummyResource = mock(ResourceMetadata::class);
        $dummyResource->expects('getName')->once()->andReturns('app_dummy');

        $registry = new BaseResourceMetadataRegistry();
        $registry->addMetadata($dummyResource);

        expect($registry->findByName('app_dummy'))->toBe($dummyResource)
            ->and($registry->findByName('other_dummy'))->toBeNull()
        ;
    });
});
