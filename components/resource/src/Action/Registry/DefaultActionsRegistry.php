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

namespace Alphpaca\Component\Resource\Action\Registry;

use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Middleware;
use Alphpaca\Contracts\Resource\Action\Registry\ActionCannotBeAddedException;
use Alphpaca\Contracts\Resource\Action\Registry\ActionMiddlewareCannotBeAddedException;
use Alphpaca\Contracts\Resource\Action\Registry\Registry;

final class DefaultActionsRegistry implements Registry
{
    /** @var array<string, Action> */
    private array $actions = [];

    private MiddlewaresCollection $defaultMiddlewares;

    /** @var array<class-string<Action>, MiddlewaresCollection> */
    private array $middlewares = [];

    public function __construct()
    {
        $this->defaultMiddlewares = new MiddlewaresCollection();
    }

    public function add(string $name, Action $resourceAction): void
    {
        if (isset($this->actions[$name])) {
            throw new ActionCannotBeAddedException($name, $resourceAction, 'Action "%s" cannot be added to the registry as the action with the same name already exists.');
        }

        $this->actions[$name] = $resourceAction;
    }

    public function addDefaultMiddleware(Middleware $middleware, int $priority = 0): void
    {
        $this->defaultMiddlewares->insert($middleware, $priority);
    }

    /**
     * @return array<array{middleware: Middleware, priority: int}>
     */
    public function getDefaultMiddlewares(): array
    {
        $queue = clone $this->defaultMiddlewares;
        $queue->setExtractFlags(\SplPriorityQueue::EXTR_BOTH);

        $result = [];

        /**
         * @var array{data: Middleware, priority: int} $item
         *
         * @phpstan-ignore varTag.nativeType
         */
        foreach ($queue as $item) {
            $result[] = [
                'middleware' => $item['data'],
                'priority' => $item['priority'],
            ];
        }

        return $result;
    }

    public function addActionMiddleware(string $actionName, Middleware $middleware, int $priority = 0): void
    {
        if (!isset($this->actions[$actionName])) {
            throw new ActionMiddlewareCannotBeAddedException($actionName, $middleware, '"%s" middleware cannot be added, as the "%s" action does not exist.');
        }

        if (!isset($this->middlewares[$actionName])) {
            $this->middlewares[$actionName] = new MiddlewaresCollection();
        }

        $this->middlewares[$actionName]->insert($middleware, $priority);
    }

    /**
     * @return array<array{middleware: Middleware, priority: int}>
     */
    public function getActionMiddlewares(string $actionName): array
    {
        if (!isset($this->middlewares[$actionName])) {
            return [];
        }

        $queue = clone $this->middlewares[$actionName];
        $queue->setExtractFlags(\SplPriorityQueue::EXTR_BOTH);

        $result = [];

        /** @var array{data: Middleware, priority: int} $item */
        foreach ($queue as $item) {
            $result[] = [
                'middleware' => $item['data'],
                'priority' => $item['priority'],
            ];
        }

        return $result;
    }

    public function getByName(string $name): ?Action
    {
        return $this->actions[$name] ?? null;
    }
}
