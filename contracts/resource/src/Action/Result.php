<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Action;

/**
 * A marker interface for discriminating action results.
 *
 * @since 0.1
 */
interface Result
{
    /**
     * Returns whether the result is successful.
     *
     * @return bool whether the result is successful
     *
     * @since 0.1
     */
    public function isSuccessful(): bool;
}
