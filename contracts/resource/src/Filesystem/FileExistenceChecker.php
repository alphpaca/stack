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

namespace Alphpaca\Contracts\Resource\Filesystem;

/**
 * A representation of a service checking if a given file exists.
 *
 * @since v0.1
 */
interface FileExistenceChecker
{
    /**
     * Returns true if the given file exists, false otherwise.
     *
     * @since v0.1
     */
    public function exists(string $path): bool;
}
