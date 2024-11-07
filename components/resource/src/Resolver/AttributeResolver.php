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
use Alphpaca\Contracts\Resource\Resolver\AttributeResolver as AttributeResolverContract;
use Roave\BetterReflection\Reflector\Reflector;

final readonly class AttributeResolver implements AttributeResolverContract
{
    public function __construct(
        private Reflector $reflector,
        private ObjectFactory $objectFactory,
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
        $reflectedClass = $this->reflector->reflectClass($className);
        $foundAttributes = $reflectedClass->getAttributesByInstance($attributeName);

        if (0 === count($foundAttributes)) {
            return null;
        }

        $firstFoundAttribute = array_shift($foundAttributes);
        /** @var class-string<T> $foundAttributeName */
        $foundAttributeName = $firstFoundAttribute->getName();

        return $this->objectFactory->create($foundAttributeName, ...$firstFoundAttribute->getArguments());
    }
}
