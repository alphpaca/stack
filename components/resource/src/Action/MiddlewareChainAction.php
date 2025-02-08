<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Action;

use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Context\Context;
use Alphpaca\Contracts\Resource\Action\Input\Input;
use Alphpaca\Contracts\Resource\Action\Middleware;
use Alphpaca\Contracts\Resource\Action\Result;

class MiddlewareChainAction implements Action
{
    /** @var array<Middleware> */
    private array $middlewares;

    public function __construct(
        private readonly Action $action,
        Middleware              ...$middlewares,
    )
    {
        $this->middlewares = array_reverse($middlewares);
    }

    public function __invoke(Input $input, Context $context): Result
    {
        $next = fn(Input $input, Context $context): Result => $this->action->__invoke($input, $context);

        foreach ($this->middlewares as $middleware) {
            $next = fn(Input $input, Context $context): Result => $middleware($input, $context, $next);
        }

        return $next($input, $context);
    }
}
