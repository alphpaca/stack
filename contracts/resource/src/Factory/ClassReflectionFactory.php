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

use Alphpaca\Contracts\Resource\Factory\Exception\ClassCannotBeReflectedException;

/**
 * A representation of a service responsible for creating a class reflection object.
 *
 * @since 0.1
 */
interface ClassReflectionFactory
{
    /**
     * @template T of object
     *
     * Creates a class reflection object.
     *
     * @param class-string<T> $className the class name for which a reflection object is desired
     *
     * @return \ReflectionClass<T>
     *
     * @throws ClassCannotBeReflectedException
     *
     * @since 0.1
     */
    public function create(string $className): \ReflectionClass;
}
