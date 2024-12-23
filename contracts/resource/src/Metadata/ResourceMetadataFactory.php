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
 * A representation of a service factoring a resource metadata object.
 *
 * @since 0.1
 */
interface ResourceMetadataFactory
{
    /**
     * Creates a resource metadata from a `AsResource` attribute.
     *
     * @param class-string $className
     *
     * @since 0.1
     */
    public function createFromAttribute(string $className, AsResource $attribute): ResourceMetadata;
}
