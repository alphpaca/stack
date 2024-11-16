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

namespace Alphpaca\Contracts\Resource\Metadata;

/**
 * A representation of a service registering and resolving resource metadata.
 */
interface ResourceMetadataRegistry
{
    /**
     * Returns the metadata for a given resource name.
     *
     * @param class-string $resourceName
     */
    public function findByName(string $resourceName): ?ResourceMetadata;

    /**
     * Adds a resource metadata to the registry. Also invokes all registered extensions on this metadata.
     */
    public function addMetadata(ResourceMetadata $metadata): void;

    /**
     * Adds a given extension to the registry. This extension will be used to extend the resource metadata once it is loaded.
     * Duplicated extensions will be ignored.
     */
    public function addExtension(ResourceMetadataExtension $extension): void;

    /**
     * Returns all registered extensions.
     *
     * @return array<ResourceMetadataExtension>
     */
    public function getExtensions(): array;
}
