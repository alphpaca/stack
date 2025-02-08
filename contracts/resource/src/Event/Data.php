<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Event;

use Alphpaca\Contracts\Resource\Shared\DataBag\DataBag;

/**
 * A representation of an event data.
 *
 * @since 0.1
 */
interface Data extends DataBag
{
}
