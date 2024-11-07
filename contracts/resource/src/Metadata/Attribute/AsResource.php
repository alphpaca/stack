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

namespace Alphpaca\Contracts\Resource\Metadata\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class AsResource
{
    public function __construct(
        protected readonly string $name,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
