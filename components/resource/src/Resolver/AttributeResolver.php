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

namespace Alphpaca\Component\Resource\Resolver;

use Alphpaca\Contracts\Resource\Factory\ObjectFactory;
use Alphpaca\Contracts\Resource\Resolver\AncestorsResolver;
use Alphpaca\Contracts\Resource\Resolver\AttributeResolver as AttributeResolverContract;
use Alphpaca\Contracts\Resource\Resolver\Exception\ResolvingException;
use Roave\BetterReflection\Reflector\Exception\IdentifierNotFound;
use Roave\BetterReflection\Reflector\Reflector;

final readonly class AttributeResolver implements AttributeResolverContract
{
    public function __construct(
        private Reflector $reflector,
        private ObjectFactory $objectFactory,
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
            $reflectedClass = $this->reflector->reflectClass($className);
        } catch (IdentifierNotFound $e) {
            throw new ResolvingException(sprintf('Class "%s" does not exist.', $className), previous: $e);
        }

        $foundAttributes = $reflectedClass->getAttributesByInstance($attributeName);

        if (0 === count($foundAttributes)) {
            return null;
        }

        $firstFoundAttribute = array_shift($foundAttributes);
        /** @var class-string<T> $foundAttributeName */
        $foundAttributeName = $firstFoundAttribute->getName();

        return $this->objectFactory->create($foundAttributeName, ...$firstFoundAttribute->getArguments());
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
