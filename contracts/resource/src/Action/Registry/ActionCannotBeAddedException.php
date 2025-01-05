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

class ActionCannotBeAddedException extends \RuntimeException
{
    public function __construct(
        private readonly Action $action,
        string $message = 'Action "%s" cannot be added to the registry.',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct(
            sprintf($message, $this->action->getName()),
            $code,
            $previous,
        );
    }

    public function getAction(): Action
    {
        return $this->action;
    }
}
