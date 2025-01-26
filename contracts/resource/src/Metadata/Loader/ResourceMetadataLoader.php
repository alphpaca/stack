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

namespace Alphpaca\Contracts\Resource\Metadata\Loader;

use Alphpaca\Contracts\Resource\Metadata\Loader\Exception\ResourceMetadataLoadingException;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;

/**
 * A representation of a service loading a resource metadata.
 *
 * @since 0.1
 */
interface ResourceMetadataLoader
{
    /**
     * Loads a resource metadata from a given file path.
     *
     * If the loader does not support the given file path, it throws an exception.
     * Call the `supports` method to check if the loader supports the given file path.
     *
     * @throws ResourceMetadataLoadingException
     *
     * @since 0.1
     */
    public function loadFromFile(string $path): ?ResourceMetadata;

    /**
     * Returns whether the given file path is supported by the loader.
     *
     * @since 0.1
     */
    public function supports(string $path): bool;
}
