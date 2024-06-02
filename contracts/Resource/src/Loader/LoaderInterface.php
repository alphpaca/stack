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

namespace Alphpaca\Contracts\Resource\Loader;

use Alphpaca\Contracts\Resource\Loader\Exception\ResourceLoaderException;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataInterface;

/**
 * Contract for loading resource from different sources.
 *
 * @author Jacob Tobiasz <jacob@alphpaca.io>
 *
 * @since 0.1
 */
interface LoaderInterface
{
    /**
     * It loads the resource from the given source. It might be a file path, array, or any other source,
     * depending on the implementation.
     *
     * @since 0.1
     *
     * @throws ResourceLoaderException
     */
    public function load(mixed $source): ResourceMetadataInterface;

    /**
     * It checks if the loader supports the given source.
     *
     * @since 0.1
     */
    public function supports(mixed $source): bool;
}
