<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Factory;

use Alphpaca\Contracts\Resource\Factory\Exception\ObjectCannotBeFactoredException;

/**
 * A representation of a service responsible for instantiating a given class with provided parameters.
 *
 * @since 0.1
 */
interface ObjectFactory
{
	/**
	 * @template T of object
	 *
	 * @param class-string<T> $className
	 * @param array<mixed> $args
	 *
	 * @phpstan-return T
	 *
	 * @throws ObjectCannotBeFactoredException
	 *
	 * @since 0.1
	 */
	public function create(string $className, mixed ...$args): object;
}
