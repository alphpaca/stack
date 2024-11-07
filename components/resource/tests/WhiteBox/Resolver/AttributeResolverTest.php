<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Resolver\AttributeResolver;
use Alphpaca\Contracts\Resource\Factory\ObjectFactory;
use Roave\BetterReflection\Reflection\ReflectionAttribute;
use Roave\BetterReflection\Reflection\ReflectionClass;
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
        $objectFactory->expects('create')->with('\App\MyAttribute', 'some_argument', 'another_argument')->andReturns($object = new \stdClass());

        $testSubject = new AttributeResolver($reflector, $objectFactory);
        $result = $testSubject->resolveFirst('\App\Book', '\App\MyAttribute');

        expect($result)->toBe($object);
    });

    it('returns null if no attribute is found', function () {
        $reflector = mock(Reflector::class);
        $reflector->expects('reflectClass')->with('\App\Book')->andReturns($reflectedClass = mock(ReflectionClass::class));

        $reflectedClass->expects('getAttributesByInstance')->with('\App\MyAttribute')->andReturns([]);

        $objectFactory = mock(ObjectFactory::class);

        $testSubject = new AttributeResolver($reflector, $objectFactory);
        $result = $testSubject->resolveFirst('\App\Book', '\App\MyAttribute');

        expect($result)->toBeNull();
    });
});
