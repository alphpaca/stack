<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Action\Registry;

use Alphpaca\Contracts\Resource\Action\Middleware;

/**
 * @internal this class is used only in the registry and never leaks out of it
 *
 * @extends \SplPriorityQueue<int, Middleware>
 */
final class MiddlewaresCollection extends \SplPriorityQueue
{
    public function compare(mixed $priority1, mixed $priority2): int
    {
        return $priority2 - $priority1;
    }
}
