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

use Alphpaca\Contracts\Resource\Factory\ClassReflectionFactory as ClassReflectionFactoryContract;
use Alphpaca\Contracts\Resource\Factory\Exception\ClassCannotBeReflectedException;

final class ClassReflectionFactory implements ClassReflectionFactoryContract
{
    public function create(string $className): \ReflectionClass
    {
        if (!class_exists($className)) {
            throw new ClassCannotBeReflectedException(sprintf('Class "%s" does not exist.', $className));
        }

        return new \ReflectionClass($className);
    }
}
