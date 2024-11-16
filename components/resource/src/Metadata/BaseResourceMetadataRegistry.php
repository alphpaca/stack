<?php

declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Metadata;

use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataExtension;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataRegistry;

final class BaseResourceMetadataRegistry implements ResourceMetadataRegistry
{
    /** @var array<ResourceMetadata> */
    private array $metadata = [];

    /** @var array<ResourceMetadataExtension> */
    private array $extensions = [];

    public function findByName(string $resourceName): ?ResourceMetadata
    {
        return $this->metadata[$resourceName] ?? null;
    }

    public function addMetadata(ResourceMetadata $metadata): void
    {
        foreach ($this->extensions as $extension) {
            $extension->extend($metadata);
        }

        $this->metadata[$metadata->getName()] = $metadata;
    }

    public function addExtension(ResourceMetadataExtension $extension): void
    {
        if (in_array($extension, $this->extensions, true)) {
            return;
        }

        $this->extensions[] = $extension;
    }

    public function getExtensions(): array
    {
        return $this->extensions;
    }
}
