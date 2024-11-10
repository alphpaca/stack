<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Resolver\AttributeResolver;
use Alphpaca\Contracts\Resource\Factory\ObjectFactory;
use Alphpaca\Contracts\Resource\Resolver\AncestorsResolver;
use Alphpaca\Contracts\Resource\Resolver\Exception\ResolvingException;
use Roave\BetterReflection\Identifier\Identifier;
use Roave\BetterReflection\Identifier\IdentifierType;
use Roave\BetterReflection\Reflection\ReflectionAttribute;
use Roave\BetterReflection\Reflection\ReflectionClass;
use Roave\BetterReflection\Reflector\Exception\IdentifierNotFound;
use Roave\BetterReflection\Reflector\Reflector;

describe('Attribute Resolver', function () {
    it('resolves first attribute with a given name', function () {
        $reflector = mock(Reflector::class);
        $reflector->expects('reflectClass')->with('\App\Book')->andReturns($reflectedClass = mock(ReflectionClass::class));

        $reflectedClass->expects('getAttributesByInstance')->with('\App\MyAttribute')->andReturns([
            $firstFoundAttribute = mock(ReflectionAttribute::class),
            mock(ReflectionAttribute::class),
        ]);

        $firstFoundAttribute->expects('getName')->andReturns('\App\MyAttribute');
        $firstFoundAttribute->expects('getArguments')->andReturns(['some_argument', 'another_argument']);

        $objectFactory = mock(ObjectFactory::class);
        $objectFactory->expects('create')->with('\App\MyAttribute', 'some_argument', 'another_argument')->andReturns($object = new stdClass());

        $ancestorsResolver = mock(AncestorsResolver::class);

        $testSubject = new AttributeResolver($reflector, $objectFactory, $ancestorsResolver);
        $result = $testSubject->resolveFirst('\App\Book', '\App\MyAttribute');

        expect($result)->toBe($object);
    });

    it('returns null if no attribute is found', function () {
        $reflector = mock(Reflector::class);
        $reflector->expects('reflectClass')->with('\App\Book')->andReturns($reflectedClass = mock(ReflectionClass::class));

        $reflectedClass->expects('getAttributesByInstance')->with('\App\MyAttribute')->andReturns([]);

        $objectFactory = mock(ObjectFactory::class);
        $ancestorsResolver = mock(AncestorsResolver::class);

        $testSubject = new AttributeResolver($reflector, $objectFactory, $ancestorsResolver);
        $result = $testSubject->resolveFirst('\App\Book', '\App\MyAttribute');

        expect($result)->toBeNull();
    });

    it('throws an exception while trying to resolve an attribute for a non existing class', function () {
        $reflector = mock(Reflector::class);
        $reflector->expects('reflectClass')->with('\App\Book')->andThrows(
            IdentifierNotFound::fromIdentifier(new Identifier('\App\Book', new IdentifierType())),
        );

        $objectFactory = mock(ObjectFactory::class);
        $ancestorsResolver = mock(AncestorsResolver::class);

        $testSubject = new AttributeResolver($reflector, $objectFactory, $ancestorsResolver);
        $testSubject->resolveFirst('\App\Book', '\App\MyAttribute');
    })->throws(ResolvingException::class, 'Class "\App\Book" does not exist.');

    it('returns ancestors attributes', function () {
        $ancestorsResolver = mock(AncestorsResolver::class);
        $ancestorsResolver->expects('resolve')->with('\App\Book')->andReturns([
            '\App\ParentBook',
            '\App\GrandParentBook',
        ]);

        $reflector = mock(Reflector::class);
        $reflector->expects('reflectClass')->with('\App\ParentBook')->andReturns($parentBookClass = mock(ReflectionClass::class));
        $reflector->expects('reflectClass')->with('\App\GrandParentBook')->andReturns($grandParentBookClass = mock(ReflectionClass::class));

        $parentBookClass->expects('getAttributesByInstance')->with('\App\MyAttribute')->andReturns([
            $parentBookClassResourceAttribute = mock(ReflectionAttribute::class),
        ]);

        $parentBookClassResourceAttribute->expects('getName')->andReturns('\App\MyAttribute');
        $parentBookClassResourceAttribute->expects('getArguments')->andReturns(['parent_book']);

        $grandParentBookClass->expects('getAttributesByInstance')->with('\App\MyAttribute')->andReturns([
            $grandParentBookClassResourceAttribute = mock(ReflectionAttribute::class),
        ]);

        $grandParentBookClassResourceAttribute->expects('getName')->andReturns('\App\MyAttribute');
        $grandParentBookClassResourceAttribute->expects('getArguments')->andReturns(['grand_parent_book']);

        $objectFactory = mock(ObjectFactory::class);
        $objectFactory->expects('create')->with('\App\MyAttribute', 'parent_book')->andReturns($parentBookClassAttributeObject = new stdClass);
        $objectFactory->expects('create')->with('\App\MyAttribute', 'grand_parent_book')->andReturns($grandParentBookClassAttributeObject = new stdClass);

        $testSubject = new AttributeResolver($reflector, $objectFactory, $ancestorsResolver);
        $result = $testSubject->resolveForAncestors('\App\Book', '\App\MyAttribute');

        expect($result)->toBe([
            $parentBookClassAttributeObject,
            $grandParentBookClassAttributeObject,
        ]);
    });

    it('throws an exception while trying to resolve ancestors attributes for a non existing class', function () {
        $reflector = mock(Reflector::class);
        $objectFactory = mock(ObjectFactory::class);
        $ancestorsResolver = mock(AncestorsResolver::class);
        $ancestorsResolver->expects('resolve')->with('\App\Book')->andThrows(new ResolvingException(
            'Class "\App\Book" does not exist.',
        ));

        $testSubject = new AttributeResolver($reflector, $objectFactory, $ancestorsResolver);
        $testSubject->resolveForAncestors('\App\Book', '\App\MyAttribute');
    })->throws(ResolvingException::class, 'Class "\App\Book" does not exist.');
});
