<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Resolver;

use Alphpaca\Contracts\Resource\Resolver\AncestorsResolver as AncestorsResolverContract;
use Alphpaca\Contracts\Resource\Resolver\Exception\ResolvingException;

final readonly class AncestorsResolver implements AncestorsResolverContract
{
	public function resolve(string $class): array
	{
		$result = class_parents($class);

		if ($result === false) {
			throw new ResolvingException(sprintf('Could not resolve ancestors for class "%s".', $class));
		}

		return $result;
	}
}
