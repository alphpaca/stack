<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Resolver\AncestorsResolver;
use Roave\BetterReflection\BetterReflection;
use Tests\Alphpaca\Component\Resource\BlackBox\Resolver\DataFixtures\ChildBook;
use Tests\Alphpaca\Component\Resource\BlackBox\Resolver\DataFixtures\GrandparentBook;
use Tests\Alphpaca\Component\Resource\BlackBox\Resolver\DataFixtures\ParentBook;

describe('Ancestors Resolver', function () {
    covers(AncestorsResolver::class);

    $resolver = new AncestorsResolver(
        (new BetterReflection())->reflector(),
    );

    it('returns ancestors for a given class', function () use ($resolver) {
        $result = $resolver->resolve(ChildBook::class);

        expect($result)->toBe([
            ParentBook::class,
            GrandparentBook::class,
        ]);
    });
});
