<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\Merger\DefaultMerger;
use Alphpaca\Contracts\Resource\Metadata\Merger\Exception\ResourceMetadataObjectsMergingException;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;
use Tests\Alphpaca\Component\Resource\Helper\Factory\ResourceMetadataFactory;
use Tests\Alphpaca\Component\Resource\Helper\Resource\DummyResource;
use Tests\Alphpaca\Component\Resource\Helper\Resource\ExampleResource;
use Tests\Alphpaca\Component\Resource\Helper\Resource\SuperDummyResource;
use Tests\Alphpaca\Component\Resource\Helper\Resource\ZummyResource;

describe('Default Merger', function () {
    it('returns false if two resource metadata objects cannot be merged due to different names', function () {
        $merger = new DefaultMerger();

        $dummyResource = ResourceMetadataFactory::withName('app_dummy');
        $zummyResource = ResourceMetadataFactory::withName('app_zummy');

        expect($merger->canBeMerged($dummyResource, $zummyResource))->toBeFalse();
    });

    it('returns false if two resource metadata objects cannot be merged due to not being ancestors', function () {
        $merger = new DefaultMerger();

        $exampleResource = ResourceMetadataFactory::withName('app_dummy');
        $exampleResource = ResourceMetadataFactory::withClass(ExampleResource::class, $exampleResource);

        $dummyResource = ResourceMetadataFactory::withName('app_dummy');
        $dummyResource = ResourceMetadataFactory::withClass(DummyResource::class, $dummyResource);

        expect($merger->canBeMerged($exampleResource, $dummyResource))->toBeFalse();
    });

    it('returns true if two resource metadata objects can be merged', function () {
        $merger = new DefaultMerger();

        $exampleResource = ResourceMetadataFactory::withName('app_dummy');
        $exampleResource = ResourceMetadataFactory::withClass(DummyResource::class, $exampleResource);

        $dummyResource = ResourceMetadataFactory::withName('app_dummy');
        $dummyResource = ResourceMetadataFactory::withClass(DummyResource::class, $dummyResource);

        expect($merger->canBeMerged($exampleResource, $dummyResource))->toBeTrue();
    });

    it('throws an exception when trying to merge two incompatible resource metadata objects', function () {
        $merger = new DefaultMerger();

        $exampleResource = ResourceMetadataFactory::withName('app_dummy');
        $exampleResource = ResourceMetadataFactory::withClass(DummyResource::class, $exampleResource);

        $dummyResource = ResourceMetadataFactory::withName('app_zummy');
        $dummyResource = ResourceMetadataFactory::withClass(ZummyResource::class, $dummyResource);

        $merger->merge($exampleResource, $dummyResource);
    })->throws(ResourceMetadataObjectsMergingException::class, 'The provided resource metadata objects are not compatible.');

    it('merges two resource metadata objects', function () {
        $merger = new DefaultMerger();

        $exampleResource = ResourceMetadataFactory::example(
            name: 'app_dummy',
            class: DummyResource::class,
            source: DummyResource::class,
            sourceType: MetadataSourceType::ATTRIBUTE,
            priority: -10,
        );

        $dummyResource = ResourceMetadataFactory::example(
            name: 'app_dummy',
            class: SuperDummyResource::class,
            source: SuperDummyResource::class,
            sourceType: MetadataSourceType::ATTRIBUTE,
            priority: 10,
        );

        $mergingResult = $merger->merge($exampleResource, $dummyResource);

        expect($mergingResult)->not->toBe($dummyResource)
            ->and($mergingResult)->toMatchObject([
                'name' => 'app_dummy',
                'class' => SuperDummyResource::class,
                'source' => DefaultMerger::class,
                'sourceType' => MetadataSourceType::MERGING,
                'priority' => 10,
            ])
        ;
    });
});
