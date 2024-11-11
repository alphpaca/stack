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

namespace Alphpaca\Contracts\Resource;

/**
 * Represents an identity of a resource.
 *
 * @template TValue of string|int
 */
interface Identity extends \Stringable, \Serializable, \JsonSerializable
{
    /**
     * Returns the underlying value.
     *
     * @phpstan-return TValue
     *
     * @since 0.1
     */
    public function getValue(): string|int;

    /**
     * Returns a string representation of the identity.
     *
     * This method is identical to {@see __toString()} and exists for
     * compatibility with interfaces like {@see \Stringable}.
     *
     * @since 0.1
     */
    public function toString(): string;
}
