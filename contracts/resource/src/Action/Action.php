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
 *
 * @since 0.1
 */
interface Action
{
    /**
     * Performs the action.
     *
     * @param Input $input additional data passed to the action
     * @param Context $context the context of the action
     *
     * @return Result the result of the action
     *
     * @since 0.1
     */
    public function __invoke(Input $input, Context $context): Result;
}
