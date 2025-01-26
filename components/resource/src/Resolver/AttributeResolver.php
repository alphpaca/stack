<?php

declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Resolver;

use Alphpaca\Contracts\Resource\Factory\ClassReflectionFactory;
use Alphpaca\Contracts\Resource\Factory\Exception\ClassCannotBeReflectedException;
use Alphpaca\Contracts\Resource\Resolver\AncestorsResolver;
use Alphpaca\Contracts\Resource\Resolver\AttributeResolver as AttributeResolverContract;
use Alphpaca\Contracts\Resource\Resolver\Exception\ResolvingException;

final readonly class AttributeResolver implements AttributeResolverContract
{
    public function __construct(
        private ClassReflectionFactory $classReflectionFactory,
        private AncestorsResolver $ancestorsResolver,
    ) {
    }

    /**
     * @template T of object
     *
     * @param class-string    $className
     * @param class-string<T> $attributeName
     *
     * @phpstan-return T|null
     *
     * @since 0.1
     */
    public function resolveFirst(string $className, string $attributeName): mixed
    {
        try {
            $reflectedClass = $this->classReflectionFactory->create($className);
        } catch (ClassCannotBeReflectedException $e) {
            throw new ResolvingException(sprintf('Attribute "%s" cannot be resolved from class "%s".', $attributeName, $className), previous: $e);
        }

        $foundAttributes = $reflectedClass->getAttributes($attributeName, \ReflectionAttribute::IS_INSTANCEOF);

        if (0 === count($foundAttributes)) {
            return null;
        }

        $firstFoundAttribute = array_shift($foundAttributes);

        return $firstFoundAttribute->newInstance();
    }

    public function resolveForAncestors(string $className, string $attributeName): array
    {
        $result = [];
        $ancestors = $this->ancestorsResolver->resolve($className);

        foreach ($ancestors as $ancestor) {
            $resolvedAncestorAttribute = $this->resolveFirst($ancestor, $attributeName);

            if (null === $resolvedAncestorAttribute) {
                continue;
            }

            $result[] = $resolvedAncestorAttribute;
        }

        return $result;
    }
}
