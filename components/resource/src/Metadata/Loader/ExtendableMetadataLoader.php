<?php

declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Metadata\Loader;

use Alphpaca\Contracts\Resource\Metadata\Loader\ExtendableResourceMetadataLoader;
use Alphpaca\Contracts\Resource\Metadata\Loader\ResourceMetadataLoader;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataExtension;

final class ExtendableMetadataLoader implements ExtendableResourceMetadataLoader
{
    /** @var array<ResourceMetadataExtension> */
    private array $extensions = [];

    public function __construct(
        private readonly ResourceMetadataLoader $baseLoader,
    )
    {
    }

    public function loadFromFile(string $path): ?ResourceMetadata
    {
        $resourceMetadata = $this->baseLoader->loadFromFile($path);

        if (null === $resourceMetadata) {
            return null;
        }

        foreach ($this->extensions as $extension) {
            $extension->extend($resourceMetadata);
        }

        return $resourceMetadata;
    }

    public function addExtension(ResourceMetadataExtension $extension): void
    {
        $this->extensions[] = $extension;
    }

    public function supports(string $path): bool
    {
        return $this->baseLoader->supports($path);
    }
}
