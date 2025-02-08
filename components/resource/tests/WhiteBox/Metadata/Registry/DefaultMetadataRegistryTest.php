<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Metadata\Registry\DefaultMetadataRegistry;
use Alphpaca\Contracts\Resource\Metadata\Merger\Merger;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;

describe('Default Resource Metadata Registry', function () {
    covers(DefaultMetadataRegistry::class);

    it('stores resource metadata', function () {
        $registry = new DefaultMetadataRegistry(mock(Merger::class));

        $dummyMetadata = mock(ResourceMetadata::class);
        $dummyMetadata->allows('getName')->andReturns('app_dummy');
        $dummyMetadata->allows('getClass')->andReturns('\App\Dummy');
        $dummyMetadata->allows('getPriority')->andReturns(0);

        expect($registry->getByName('app_dummy'))->toBeNull();

        $registry->add($dummyMetadata);

        expect($registry->getByName('app_dummy'))->toBe($dummyMetadata);
    });

    it('retrieves resource metadata by name', function () {
        $registry = new DefaultMetadataRegistry(mock(Merger::class));

        $dummyMetadata = mock(ResourceMetadata::class);
        $dummyMetadata->allows('getName')->andReturns('app_dummy');
        $dummyMetadata->allows('getClass')->andReturns('\App\Dummy');
        $dummyMetadata->allows('getPriority')->andReturns(0);

        $zummyMetadata = mock(ResourceMetadata::class);
        $zummyMetadata->allows('getName')->andReturns('app_zummy');
        $zummyMetadata->allows('getClass')->andReturns('\App\Zummy');
        $zummyMetadata->allows('getPriority')->andReturns(1);

        $registry->add($dummyMetadata);
        $registry->add($zummyMetadata);

        expect($registry->getByName('app_dummy'))->toBe($dummyMetadata)
            ->and($registry->getByName('app_zummy'))->toBe($zummyMetadata)
        ;
    });

    it('returns merged resource metadata objects if two or more resource metadata objects have the same name', function () {
        $registry = new DefaultMetadataRegistry($merger = mock(Merger::class));

        $dummyMetadata = mock(ResourceMetadata::class);
        $dummyMetadata->allows('getName')->andReturns('app_dummy');
        $dummyMetadata->allows('getClass')->andReturns('\App\Dummy');
        $dummyMetadata->allows('getPriority')->andReturns(0);

        $superDummyMetadata = mock(ResourceMetadata::class);
        $superDummyMetadata->allows('getName')->andReturns('app_dummy');
        $superDummyMetadata->allows('getClass')->andReturns('\App\SuperDummy');
        $superDummyMetadata->allows('getPriority')->andReturns(-10);

        $zummyMetadata = mock(ResourceMetadata::class);
        $zummyMetadata->allows('getName')->andReturns('app_dummy');
        $zummyMetadata->allows('getClass')->andReturns('\App\Zummy');
        $zummyMetadata->allows('getPriority')->andReturns(10);

        $registry->add($dummyMetadata);
        $registry->add($zummyMetadata);
        $registry->add($superDummyMetadata);

        $merger->expects('merge')->once()->with($superDummyMetadata, $dummyMetadata)->andReturns($mergingResult = mock(ResourceMetadata::class));
        $merger->expects('merge')->once()->with($mergingResult, $zummyMetadata)->andReturns($finalMergingResult = mock(ResourceMetadata::class));

        expect($registry->getByName('app_dummy'))->toBe($finalMergingResult);
    });

    it('returns null if a resource metadata with a given name is not found', function () {
        $registry = new DefaultMetadataRegistry(mock(Merger::class));

        expect($registry->getByName('app_dummy'))->toBeNull();
    });
});
