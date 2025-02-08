<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Metadata\Merger\DefaultMerger;
use Alphpaca\Component\Resource\Metadata\Registry\DefaultMetadataRegistry;
use Alphpaca\Component\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;
use Tests\Alphpaca\Component\Resource\BlackBox\Metadata\Registry\DataFixtures\Bummy;
use Tests\Alphpaca\Component\Resource\BlackBox\Metadata\Registry\DataFixtures\Dummy;
use Tests\Alphpaca\Component\Resource\BlackBox\Metadata\Registry\DataFixtures\SuperDummy;
use Tests\Alphpaca\Component\Resource\BlackBox\Metadata\Registry\DataFixtures\UltraDummy;

describe('Default Metadata Registry', function () {
	covers(DefaultMetadataRegistry::class);

	$registryFactory = fn() => new DefaultMetadataRegistry(new DefaultMerger());

	it('returns a resource metadata matching the given name', function () use ($registryFactory) {
		$registry = $registryFactory();

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
			->and($registry->getByName('app_dummy'))->toBe($dummyMetadata);
	});

	it('returns merged resource metadata objects if two or more resource metadata objects have the same name', function () use ($registryFactory) {
		$registry = $registryFactory();

		$dummyMetadata = new ResourceMetadata(
			'app_dummy',
			Dummy::class,
			MetadataSourceType::ATTRIBUTE,
			Dummy::class,
		);
		$superDummy = new ResourceMetadata(
			'app_dummy',
			SuperDummy::class,
			MetadataSourceType::ATTRIBUTE,
			SuperDummy::class,
			priority: 10,
		);
		$ultraDummy = new ResourceMetadata(
			'app_dummy',
			UltraDummy::class,
			MetadataSourceType::ATTRIBUTE,
			UltraDummy::class,
			priority: 20,
		);

		$registry->add($dummyMetadata);
		$registry->add($superDummy);
		$registry->add($ultraDummy);

		expect($registry->getByName('app_dummy'))->toMatchObject([
			'class' => UltraDummy::class,
			'name' => 'app_dummy',
			'source' => DefaultMerger::class,
			'sourceType' => MetadataSourceType::MERGING,
		]);
	});
});
