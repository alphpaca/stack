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

namespace Alphpaca\Contracts\Resource\Resolver;

use Alphpaca\Contracts\Resource\Resolver\Exception\ResolvingException;

/**
 * A representation of a service resolving ancestors for a given class.
 *
 * @since 0.1
 */
interface AncestorsResolver
{
    /**
     * Resolve ancestors for a given class.
     *
     * @param class-string $class
     *
     * @return array<class-string>
     *
     * @throws ResolvingException
     *
     * @since 0.1
     */
    public function resolve(string $class): array;
}
