<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\Registry\DefaultMetadataRegistry;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;

describe('Default Resource Metadata Registry', function () {
    covers(DefaultMetadataRegistry::class);

    it('stores resource metadata', function () {
        $registry = new DefaultMetadataRegistry();

        $registry->add(mock(ResourceMetadata::class));
    })->doesNotPerformAssertions();
});
