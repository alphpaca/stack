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
use Alphpaca\Contracts\Resource\Metadata\Merger\Merger;
use Alphpaca\Contracts\Resource\Metadata\Registry\Registry;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Resource;

final class DefaultMetadataRegistry implements Registry
{
    /** @var array<string, EntriesCollection> */
    private array $resourceNameToMetadataMap = [];

    /** @var array<class-string<Resource<Identity<string|int>>>, EntriesCollection> */
    private array $resourceClassNameToMetadataMap = [];

    public function __construct(
        private readonly Merger $resourceMetadataMerger,
    ) {
    }

    public function add(ResourceMetadata $resourceMetadata): void
    {
        $this->addResourceByName($resourceMetadata->getName(), $resourceMetadata);
        $this->addResourceByClassName($resourceMetadata->getClass(), $resourceMetadata);
    }

    private function addResourceByName(string $name, ResourceMetadata $resourceMetadata): void
    {
        if (!array_key_exists($name, $this->resourceNameToMetadataMap)) {
            $this->resourceNameToMetadataMap[$name] = new EntriesCollection();
            $this->resourceNameToMetadataMap[$name]->insert($resourceMetadata, $resourceMetadata->getPriority());

            return;
        }

        $this->resourceNameToMetadataMap[$name]->insert($resourceMetadata, $resourceMetadata->getPriority());
    }

    /**
     * @param class-string<Resource<Identity<int|string>>> $class
     */
    private function addResourceByClassName(string $class, ResourceMetadata $resourceMetadata): void
    {
        if (!array_key_exists($class, $this->resourceClassNameToMetadataMap)) {
            $this->resourceClassNameToMetadataMap[$class] = new EntriesCollection();
            $this->resourceClassNameToMetadataMap[$class]->insert($resourceMetadata, $resourceMetadata->getPriority());

            return;
        }

        $this->resourceClassNameToMetadataMap[$class]->insert($resourceMetadata, $resourceMetadata->getPriority());
    }

    public function getByName(string $name): ?ResourceMetadata
    {
        if (!array_key_exists($name, $this->resourceNameToMetadataMap)) {
            return null;
        }

        $map = $this->resourceNameToMetadataMap[$name];

        if ($map->isEmpty()) {
            return null;
        }

        $result = $map->extract();
        assert($result instanceof ResourceMetadata); // @pest-mutate-ignore

        foreach ($map as $resourceMetadata) {
            $result = $this->resourceMetadataMerger->merge($result, $resourceMetadata);
        }

        return $result;
    }

    public function getByClassName(string $className): ?ResourceMetadata
    {
        if (!array_key_exists($className, $this->resourceClassNameToMetadataMap)) {
            return null;
        }

        $map = $this->resourceClassNameToMetadataMap[$className];

        if ($map->isEmpty()) {
            return null;
        }

        $result = $map->extract();
        assert($result instanceof ResourceMetadata); // @pest-mutate-ignore

        foreach ($map as $resourceMetadata) {
            $result = $this->resourceMetadataMerger->merge($result, $resourceMetadata);
        }

        return $result;
    }
}
