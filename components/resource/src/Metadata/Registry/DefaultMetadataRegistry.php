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

namespace Alphpaca\Component\Resource\Metadata\Registry;

use Alphpaca\Contracts\Resource\Identity;
use Alphpaca\Contracts\Resource\Metadata\Registry\Registry;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Resource;

final class DefaultMetadataRegistry implements Registry
{
    /** @var array<string, ResourceMetadata> */
    private array $resourceNameToMetadataMap = [];

    /** @var array<class-string<Resource<Identity<string|int>>>, ResourceMetadata> */
    private array $resourceClassNameToMetadataMap = [];

    public function add(ResourceMetadata $resourceMetadata): void
    {
        $this->resourceNameToMetadataMap[$resourceMetadata->getName()] = $resourceMetadata;
        $this->resourceClassNameToMetadataMap[$resourceMetadata->getClass()] = $resourceMetadata;
    }

    public function getByName(string $name): ?ResourceMetadata
    {
        return $this->resourceNameToMetadataMap[$name] ?? null;
    }

    public function getByClassName(string $className): ?ResourceMetadata
    {
        return $this->resourceClassNameToMetadataMap[$className] ?? null;
    }
}
