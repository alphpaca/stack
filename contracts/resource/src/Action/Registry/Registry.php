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

namespace Alphpaca\Contracts\Resource\Action\Registry;

use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Middleware;

/**
 * A representation of a resource actions registry.
 *
 * @since 0.1
 */
interface Registry
{
    /**
     * Adds a resource metadata to the registry.
     *
     * @param string $name           the name of the action, must be unique across the registry
     * @param Action $resourceAction the action to be added
     *
     * @throws ActionCannotBeAddedException
     *
     * @since 0.1
     */
    public function add(string $name, Action $resourceAction): void;

    /**
     * Looks in the registry for an action matching the given name.
     *
     * @returns Action|null an action matching the given name or null if no matching action is found
     *
     * @since 0.1
     */
    public function getByName(string $name): ?Action;

    /**
     * Assigns a given middleware to a specific action. If the action does not exist, an exception will be thrown.
     *
     * @param class-string<Action> $actionName action name for which the middleware will be added
     * @param Middleware           $middleware middleware to be added
     * @param int                  $priority   priority of the middleware; the higher the priority, the earlier the middleware will be executed
     *
     * @throws ActionMiddlewareCannotBeAddedException
     */
    public function addActionMiddleware(string $actionName, Middleware $middleware, int $priority = 0): void;
}
