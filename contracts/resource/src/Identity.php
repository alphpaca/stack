<?php

declare(strict_types=1);

/*
 * This file is part of Eduroo (https://github.com/alphpaca/eduroo).
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
     */
    public function getValue(): string|int;

    public function toString(): string;
}
