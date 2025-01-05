<?php

declare(strict_types=1);

namespace Alphpaca\Contracts\Resource\Action\Registry;

use Alphpaca\Contracts\Resource\Action\Action;

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
     * @since 0.1
     */
    public function add(Action $resourceAction): void;

    /**
     * Looks in the registry for an action matching the given name.
     *
     * @returns Action|null an action matching the given name or null if no matching action is found
     *
     * @since 0.1
     */
    public function getByName(string $name): ?Action;
}
