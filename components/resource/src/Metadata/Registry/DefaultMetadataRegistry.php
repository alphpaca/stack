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
    /** @var array<string, \SplPriorityQueue<int, ResourceMetadata>> */
    private array $resourceNameToMetadataMap = [];

    /** @var array<class-string<Resource<Identity<string|int>>>, \SplPriorityQueue<int, ResourceMetadata>> */
    private array $resourceClassNameToMetadataMap = [];

    public function add(ResourceMetadata $resourceMetadata): void
    {
        $this->addResourceByName($resourceMetadata->getName(), $resourceMetadata);
        $this->addResourceByClassName($resourceMetadata->getClass(), $resourceMetadata);
    }

    private function addResourceByName(string $name, ResourceMetadata $resourceMetadata): void
    {
        if (!array_key_exists($name, $this->resourceNameToMetadataMap)) {
            $this->resourceNameToMetadataMap[$name] = new \SplPriorityQueue();
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
            $this->resourceClassNameToMetadataMap[$class] = new \SplPriorityQueue();
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

        return $this->resourceNameToMetadataMap[$name]->top();
    }

    public function getByClassName(string $className): ?ResourceMetadata
    {
        if (!array_key_exists($className, $this->resourceClassNameToMetadataMap)) {
            return null;
        }

        return $this->resourceClassNameToMetadataMap[$className]->top();
    }
}
