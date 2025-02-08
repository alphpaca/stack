<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Action\Registry;

use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Middleware;

/**
 * A representation of a resource actions with middlewares registry.
 *
 * @since 0.1
 */
interface MiddlewaresAwareRegistry extends Registry
{
    /**
     * Adds a default middleware to the registry.
     *
     * @param Middleware $middleware the middleware to add
     * @param int $priority the priority of the middleware (default is 0)
     *
     * @since 0.1
     */
    public function addDefaultMiddleware(Middleware $middleware, int $priority = 0): void;

    /**
     * Retrieves all default middlewares.
     *
     * @return array<array{middleware: Middleware, priority: int}> an array of default middlewares
     *
     * @since 0.1
     */
    public function getDefaultMiddlewares(): array;

    /**
     * Assigns a given middleware to a specific action. If the action does not exist, an exception will be thrown.
     *
     * @param class-string<Action> $actionName action name for which the middleware will be added
     * @param Middleware $middleware middleware to be added
     * @param int $priority priority of the middleware; the higher the priority, the earlier the middleware will be executed
     *
     * @throws ActionMiddlewareCannotBeAddedException
     *
     * @since 0.1
     */
    public function addActionMiddleware(string $actionName, Middleware $middleware, int $priority = 0): void;

    /**
     * Retrieves the list of middlewares assigned to a specific action.
     *
     * @param string $actionName the name of the action for which middlewares are being retrieved
     *
     * @return array<array{middleware: Middleware, priority: int}> an array of middlewares and their priorities
     *
     * @since 0.1
     */
    public function getActionMiddlewares(string $actionName): array;
}
