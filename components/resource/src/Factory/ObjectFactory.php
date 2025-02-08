<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Factory;

use Alphpaca\Contracts\Resource\Factory\Exception\ObjectCannotBeFactoredException;
use Alphpaca\Contracts\Resource\Factory\ObjectFactory as ObjectFactoryContract;

final readonly class ObjectFactory implements ObjectFactoryContract
{
    public function create(string $className, mixed ...$args): object
    {
        if (!class_exists($className)) {
            throw new ObjectCannotBeFactoredException(sprintf('Class "%s" does not exist, so cannot be instantiated.', $className));
        }

        return new $className(...$args);
    }
}
