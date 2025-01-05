<?php

declare(strict_types=1);

namespace Alphpaca\Contracts\Resource\Action;

/**
 * A representation of a class performing an action related to a resource.
 *
 * @since 0.1
 */
interface Action
{
    /**
     * Performs the action.
     *
     * @return Result the result of the action
     *
     * @since 0.1
     */
    public function __invoke(): Result;

    /**
     * Returns the name of the action. It should be unique across all actions.
     *
     * @return string the name of the action
     *
     * @since 0.1
     */
    public function getName(): string;
}
