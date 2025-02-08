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

use Alphpaca\Contracts\Resource\Identity;
use Alphpaca\Contracts\Resource\Resource;

/**
 * A representation of an event strictly related to a resource.
 *
 * @since 0.1
 */
interface Event
{
	/**
	 * Returns a unique identifier of the event.
	 *
	 * @return Identity<string>
	 *
	 * @since 0.1
	 */
	public function getIdentifier(): Identity;

	/**
	 * Returns the resource associated with the event.
	 *
	 * @return Resource<Identity<string|int>> A resource associated with the event.
	 *
	 * @since 0.1
	 */
	public function getResource(): Resource;

	/**
	 * Returns the data associated with the event.
	 *
	 * @return Data The data associated with the event.
	 *
	 * @since 0.1
	 */
	public function getData(): Data;
}
