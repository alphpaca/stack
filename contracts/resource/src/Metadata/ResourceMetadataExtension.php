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
 * A representation of a service manipulating a loaded resource metadata.
 *
 * @since 0.1
 */
interface ResourceMetadataExtension
{
    /**
     * Manipulates a loaded resource metadata.
     *
     * @since 0.1
     */
    public function extend(ResourceMetadata $loadedMetadata): void;
}