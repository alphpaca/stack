<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Factory\ClassReflectionFactory;
use Alphpaca\Component\Resource\Resolver\AncestorsResolver;
use Alphpaca\Component\Resource\Resolver\AttributeResolver;
use Alphpaca\Contracts\Resource\Metadata\AsResource;
use Tests\Alphpaca\Component\Resource\BlackBox\Resolver\DataFixtures\ChildBook;

describe('Attribute Resolver', function () {
    covers(AttributeResolver::class);

    $resolver = new AttributeResolver(
        new ClassReflectionFactory(),
        new AncestorsResolver(),
    );

    it('resolves a first matching attribute for a given class', function () use ($resolver) {
        $result = $resolver->resolveFirst(ChildBook::class, AsResource::class);

        expect($result)->toBeInstanceOf(AsResource::class)
            ->and($result->getName())->toBe('child_book')
        ;
    });

    it('resolves all ancestors attributes for a given class', function () use ($resolver) {
        $result = $resolver->resolveForAncestors(ChildBook::class, AsResource::class);

        expect($result)->toHaveCount(2)
            ->and($result[0])->toBeInstanceOf(AsResource::class)
            ->and($result[0]->getName())->toBe('parent_book')
            ->and($result[1])->toBeInstanceOf(AsResource::class)
            ->and($result[1]->getName())->toBe('grandparent_book')
        ;
    });
});
