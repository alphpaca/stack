<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\Registry\DefaultMetadataRegistry;
use Alphpaca\Component\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;
use Tests\Alphpaca\Component\Resource\BlackBox\Metadata\Registry\DataFixtures\Bummy;
use Tests\Alphpaca\Component\Resource\BlackBox\Metadata\Registry\DataFixtures\Dummy;

describe('Default Metadata Registry', function () {
    covers(DefaultMetadataRegistry::class);

    $registry = new DefaultMetadataRegistry();

    it('returns a resource metadata matching the given name', function () use ($registry) {
        $bummyMetadata = new ResourceMetadata(
            'app_bummy',
            Bummy::class,
            MetadataSourceType::ATTRIBUTE,
            Bummy::class,
        );
        $dummyMetadata = new ResourceMetadata(
            'app_dummy',
            Dummy::class,
            MetadataSourceType::ATTRIBUTE,
            Dummy::class,
        );

        $registry->add($bummyMetadata);
        $registry->add($dummyMetadata);

        expect($registry->getByName('app_bummy'))->toBe($bummyMetadata)
            ->and($registry->getByName('app_dummy'))->toBe($dummyMetadata)
        ;
    });

    it('returns a resource metadata matching the given class', function () use ($registry) {
        $bummyMetadata = new ResourceMetadata(
            'app_bummy',
            Bummy::class,
            MetadataSourceType::ATTRIBUTE,
            Bummy::class,
        );
        $dummyMetadata = new ResourceMetadata(
            'app_dummy',
            Dummy::class,
            MetadataSourceType::ATTRIBUTE,
            Dummy::class,
        );

        $registry->add($bummyMetadata);
        $registry->add($dummyMetadata);

        expect($registry->getByClassName(Dummy::class))->toBe($dummyMetadata)
            ->and($registry->getByClassName(Bummy::class))->toBe($bummyMetadata)
        ;
    });
});
