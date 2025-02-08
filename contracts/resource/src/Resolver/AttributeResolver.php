<?php declare(strict_types=1);

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
 * A representation of a service resolving attributes from a given class.
 *
 * @since 0.1
 */
interface AttributeResolver
{
    /**
     * @template T of object
     *
     * @param class-string $className
     * @param class-string<T> $attributeName
     *
     * @phpstan-return T|null
     *
     * @throws ResolvingException
     *
     * @since 0.1
     */
    public function resolveFirst(string $className, string $attributeName): mixed;

    /**
     * @template T of object
     *
     * @param class-string $className
     * @param class-string<T> $attributeName
     *
     * @phpstan-return array<T>
     *
     * @throws ResolvingException
     *
     * @since 0.1
     */
    public function resolveForAncestors(string $className, string $attributeName): array;
}
