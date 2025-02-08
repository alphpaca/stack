<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Metadata\Registry;

use Alphpaca\Contracts\Resource\Metadata\Merger\Merger;
use Alphpaca\Contracts\Resource\Metadata\Registry\Registry;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;

final class DefaultMetadataRegistry implements Registry
{
    /** @var array<string, EntriesCollection> */
    private array $resourceNameToMetadataMap = [];

    public function __construct(
        private readonly Merger $resourceMetadataMerger,
    )
    {
    }

    public function add(ResourceMetadata $resourceMetadata): void
    {
        $name = $resourceMetadata->getName();

        if (!array_key_exists($name, $this->resourceNameToMetadataMap)) {
            $this->resourceNameToMetadataMap[$name] = new EntriesCollection();
            $this->resourceNameToMetadataMap[$name]->insert($resourceMetadata, $resourceMetadata->getPriority());

            return;
        }

        $this->resourceNameToMetadataMap[$name]->insert($resourceMetadata, $resourceMetadata->getPriority());
    }

	public function getByName(string $name): null|ResourceMetadata
    {
        if (!array_key_exists($name, $this->resourceNameToMetadataMap)) {
            return null;
        }

        $map = $this->resourceNameToMetadataMap[$name];
        assert(!$map->isEmpty()); // @pest-mutate-ignore

        $result = $map->extract();
        assert($result instanceof ResourceMetadata); // @pest-mutate-ignore

        foreach ($map as $resourceMetadata) {
            $result = $this->resourceMetadataMerger->merge($result, $resourceMetadata);
        }

        return $result;
    }
}
