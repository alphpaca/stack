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
use Alphpaca\Contracts\Resource\Resolver\Exception\ResolvingException;
use Roave\BetterReflection\Reflector\Exception\IdentifierNotFound;
use Roave\BetterReflection\Reflector\Reflector;

final readonly class AncestorsResolver implements AncestorsResolverContract
{
    public function __construct(
        private Reflector $reflector,
    ) {
    }

    public function resolve(string $class): array
    {
        try {
            return $this->reflector->reflectClass($class)->getParentClassNames();
        } catch (IdentifierNotFound $e) {
            throw new ResolvingException(sprintf('Class "%s" does not exist.', $class), previous: $e);
        }
    }
}
