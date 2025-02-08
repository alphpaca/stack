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

/**
 * Throws when an action cannot be added to the registry.
 *
 * @since 0.1
 */
final class ActionCannotBeAddedException extends \RuntimeException
{
    /**
     * @param string $actionName action name which cannot be added
     * @param Action $action related action object
     * @param string $message exception message
     * @param int $code exception code
     * @param \Throwable|null $previous previous exception
     */
    public function __construct(
        string                  $actionName,
        private readonly Action $action,
        string                  $message = 'Action "%s" cannot be added to the registry.',
        int                     $code = 0,
        null|\Throwable $previous = null,
    )
    {
        parent::__construct(
            sprintf($message, $actionName),
            $code,
            $previous,
        );
    }

    /**
     * Returns the action that cannot be added to the registry.
     *
     * @return Action related action
     */
    public function getAction(): Action
    {
        return $this->action;
    }
}
