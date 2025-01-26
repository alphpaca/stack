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

namespace Alphpaca\Contracts\Resource\Action\Context;

/**
 * A representation of a resource action context.
 *
 * @since 0.1
 */
interface Context
{
    /**
     * Adds a value to the context bag.
     *
     * @param string $key   the key of the value
     * @param mixed  $value the value
     *
     * @since 0.1
     */
    public function add(string $key, mixed $value): void;

    /**
     * Returns a value from the context bag.
     *
     * @param string $key     the key of the value
     * @param mixed  $default the default value to return if the key is not found
     *
     * @since 0.1
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Returns whether the context bag contains the given key.
     *
     * @param string $key the key to be checked
     *
     * @returns bool whether the context bag contains the given key
     *
     * @since 0.1
     */
    public function has(string $key): bool;
}
