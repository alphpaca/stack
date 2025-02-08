<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Metadata;

use Alphpaca\Contracts\Resource\Identity;
use Alphpaca\Contracts\Resource\Resource;

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
     * @param class-string<Resource<Identity<int|string>>> $className
     *
     * @since 0.1
     */
    public function createFromAttribute(string $className, AsResource $attribute): ResourceMetadata;
}
