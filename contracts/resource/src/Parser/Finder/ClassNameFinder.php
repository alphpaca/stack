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

namespace Alphpaca\Contracts\Resource\Parser\Finder;

/**
 * A representation of a service looking for class names in a PHP code.
 *
 * @since v0.1
 */
interface ClassNameFinder
{
    /**
     * Returns the first Full Qualified Class Name found in the given PHP code. If no class name is found, null will be returned.
     *
     * @param array<mixed> $nodes
     *
     * @phpstan-return class-string|null
     *
     * @since v0.1
     */
    public function findFirst(array $nodes): ?string;
}
