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

#[\Attribute(\Attribute::TARGET_CLASS)]
class AsResource
{
    /**
     * Constructs a new `AsResource` attribute.
     *
     * @param string $name The name of the resource
     */
    public function __construct(
        protected readonly string $name,
    ) {
    }

    /**
     * Returns the name of the resource.
     */
    public function getName(): string
    {
        return $this->name;
    }
}
