<?php

declare(strict_types=1);

namespace Alphpaca\Component\Resource\Action\Registry;

use Alphpaca\Contracts\Resource\Action\Middleware;

/**
 * @internal this class is used only in the registry and never leaks out of it
 *
 * @extends \SplPriorityQueue<int, Middleware>
 */
class MiddlewaresCollection extends \SplPriorityQueue
{
    public function compare(mixed $priority1, mixed $priority2): int
    {
        return $priority2 - $priority1;
    }
}
