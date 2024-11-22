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

namespace Alphpaca\Component\Resource\Resolver;

use Alphpaca\Contracts\Resource\Resolver\AncestorsResolver as AncestorsResolverContract;

final readonly class AncestorsResolver implements AncestorsResolverContract
{
    public function resolve(string $class): array
    {
        return class_parents($class);
    }
}
