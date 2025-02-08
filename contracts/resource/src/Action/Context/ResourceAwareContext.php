<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Action\Context;

use Alphpaca\Contracts\Resource\Identity;
use Alphpaca\Contracts\Resource\Resource;

/**
 * A representation of a resource action context being aware of the resource.
 *
 * @since 0.1
 */
interface ResourceAwareContext extends Context
{
	/**
	 * Returns the resource associated with the current context.
	 *
	 * @return Resource<Identity<int|string>> the resource
	 *
	 * @since 0.1
	 */
	public function getResource(): Resource;
}
