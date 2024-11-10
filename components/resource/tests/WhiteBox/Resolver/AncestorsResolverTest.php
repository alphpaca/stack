<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Resolver\AncestorsResolver;
use Alphpaca\Contracts\Resource\Resolver\Exception\ResolvingException;
use Roave\BetterReflection\Identifier\Identifier;
use Roave\BetterReflection\Identifier\IdentifierType;
use Roave\BetterReflection\Reflection\ReflectionClass;
use Roave\BetterReflection\Reflector\Exception\IdentifierNotFound;
use Roave\BetterReflection\Reflector\Reflector;

describe('Ancestors Resolver', function () {
    it('resolves ancestors for a given class', function () {
        $reflector = mock(Reflector::class);
        $reflector->expects('reflectClass')->with('\App\Book')->andReturns($reflectedClass = mock(ReflectionClass::class));

        $reflectedClass->expects('getParentClassNames')->andReturns([
            '\App\ParentBook',
            '\App\GrandparentBook',
        ]);

        $testSubject = new AncestorsResolver($reflector);
        $result = $testSubject->resolve('\App\Book');

        expect($result)->toBe(['\App\ParentBook', '\App\GrandparentBook']);
    });

    it('throws an exception if a given class does not exist', function () {
        $reflector = mock(Reflector::class);
        $reflector->expects('reflectClass')->with('\App\Book')->andThrows(
            IdentifierNotFound::fromIdentifier(new Identifier('\App\Book', new IdentifierType())),
        );

        $testSubject = new AncestorsResolver($reflector);
        $testSubject->resolve('\App\Book');
    })->throws(ResolvingException::class, 'Class "\App\Book" does not exist.');
});
