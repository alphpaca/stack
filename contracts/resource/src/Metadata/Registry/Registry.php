<?php

declare(strict_types=1);

namespace Alphpaca\Contracts\Resource\Metadata\Registry;

use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;

/**
 * A representation of a resource metadata registry.
 *
 * @since 0.1
 */
interface Registry
{
    /**
     * Adds a resource metadata to the registry.
     *
     * @since 0.1
     */
    public function add(ResourceMetadata $resourceMetadata): void;
}
