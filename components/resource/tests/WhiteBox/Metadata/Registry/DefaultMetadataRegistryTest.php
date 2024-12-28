<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\Registry\DefaultMetadataRegistry;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;

describe('Default Resource Metadata Registry', function () {
    covers(DefaultMetadataRegistry::class);

    it('stores resource metadata', function () {
        $registry = new DefaultMetadataRegistry();

        $dummyMetadata = mock(ResourceMetadata::class);
        $dummyMetadata->allows('getName')->andReturns('app_dummy');
        $dummyMetadata->allows('getClass')->andReturns('\App\Dummy');

        expect($registry->getByName('app_dummy'))->toBeNull();

        $registry->add($dummyMetadata);

        expect($registry->getByName('app_dummy'))->toBe($dummyMetadata);
    });

    it('retrieves resource metadata by name', function () {
        $registry = new DefaultMetadataRegistry();

        $dummyMetadata = mock(ResourceMetadata::class);
        $dummyMetadata->allows('getName')->andReturns('app_dummy');
        $dummyMetadata->allows('getClass')->andReturns('\App\Dummy');

        $zummyMetadata = mock(ResourceMetadata::class);
        $zummyMetadata->allows('getName')->andReturns('app_zummy');
        $zummyMetadata->allows('getClass')->andReturns('\App\Zummy');

        $registry->add($dummyMetadata);
        $registry->add($zummyMetadata);

        expect($registry->getByName('app_dummy'))->toBe($dummyMetadata)
            ->and($registry->getByName('app_zummy'))->toBe($zummyMetadata)
        ;
    });

    it('returns null if a resource metadata with a given name is not found', function () {
        $registry = new DefaultMetadataRegistry();

        expect($registry->getByName('app_dummy'))->toBeNull();
    });

    it('retrieves resource metadata by class name', function () {
        $registry = new DefaultMetadataRegistry();

        $dummyMetadata = mock(ResourceMetadata::class);
        $dummyMetadata->allows('getName')->andReturns('app_dummy');
        $dummyMetadata->allows('getClass')->andReturns('\App\Dummy');

        $zummyMetadata = mock(ResourceMetadata::class);
        $zummyMetadata->allows('getName')->andReturns('app_zummy');
        $zummyMetadata->allows('getClass')->andReturns('\App\Zummy');

        $registry->add($dummyMetadata);
        $registry->add($zummyMetadata);

        expect($registry->getByClassName('\App\Dummy'))->toBe($dummyMetadata)
            ->and($registry->getByClassName('\App\Zummy'))->toBe($zummyMetadata)
        ;
    });

    it('returns null if a resource metadata with a given class name is not found', function () {
        $registry = new DefaultMetadataRegistry();

        expect($registry->getByClassName('\App\Dummy'))->toBeNull();
    });
});
