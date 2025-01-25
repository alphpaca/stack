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

namespace Alphpaca\Contracts\Resource\Action;

use Alphpaca\Contracts\Resource\Action\Context\Context;
use Alphpaca\Contracts\Resource\Action\Input\Input;

/**
 * A representation of a class performing an action related to a resource.
 * It can be used as a way to perform some logic before or after an action.
 *
 * @since 0.1
 */
interface Middleware
{
    /**
     * A logic to be executed before or after an action.
     *
     * @param Input    $input   additional data passed to the action
     * @param Context  $context the context of the action
     * @param callable $next    the next operation to be executed
     */
    public function __invoke(Input $input, Context $context, callable $next): Result;
}
