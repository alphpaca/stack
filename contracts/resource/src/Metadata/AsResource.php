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

#[\Attribute(\Attribute::TARGET_CLASS)]
final class AsResource
{
    /**
     * Constructs a new `AsResource` attribute.
     *
     * @param string $name The name of the resource
     */
    public function __construct(
        protected readonly string $name,
        protected readonly int    $priority = 0,
    )
    {
    }

    /**
     * Returns the name of the resource.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the priority of the resource.
     */
    public function getPriority(): int
    {
        return $this->priority;
    }
}
