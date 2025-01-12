<?php

declare(strict_types=1);

namespace Alphpaca\Contracts\Resource\Action\Registry;

use Alphpaca\Contracts\Resource\Action\Middleware;

/**
 * Throws when an action middleware cannot be added to the registry.
 *
 * @since 0.1
 */
class ActionMiddlewareCannotBeAddedException extends \RuntimeException
{
    /**
     * @param string          $actionName action name which cannot be added
     * @param Middleware          $middleware     related action middleware object
     * @param string          $message    exception message
     * @param int             $code       exception code
     * @param \Throwable|null $previous   previous exception
     */
    public function __construct(
        string $actionName,
        Middleware $middleware,
        string $message = '"%s" middleware cannot be added for the "%s" action.',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct(
            sprintf($message, get_class($middleware), $actionName),
            $code,
            $previous,
        );
    }
}
