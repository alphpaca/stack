<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Resolver\AttributeResolver;
use Alphpaca\Contracts\Resource\Factory\ClassReflectionFactory;
use Alphpaca\Contracts\Resource\Factory\Exception\ClassCannotBeReflectedException;
use Alphpaca\Contracts\Resource\Resolver\AncestorsResolver;
use Alphpaca\Contracts\Resource\Resolver\Exception\ResolvingException;

describe('Attribute Resolver', function () {
    covers(AttributeResolver::class);

    it('resolves first attribute with a given name', function () {
        $classReflectionFactory = mock(ClassReflectionFactory::class);
	    $classReflectionFactory->expects('create')->with('\App\Book')->andReturns($reflection = mock(ReflectionClass::class));

	    $reflection->expects('getAttributes')->with('\App\MyAttribute', ReflectionAttribute::IS_INSTANCEOF)->andReturns([
		    $firstFoundAttribute = mock(ReflectionAttribute::class),
		    mock(ReflectionAttribute::class),
        ]);

        $firstFoundAttribute->expects('newInstance')->andReturns($object = new stdClass);

        $ancestorsResolver = mock(AncestorsResolver::class);

        $testSubject = new AttributeResolver($classReflectionFactory, $ancestorsResolver);
        $result = $testSubject->resolveFirst('\App\Book', '\App\MyAttribute');

        expect($result)->toBe($object);
    });

    it('returns null if no attribute is found', function () {
        $classReflectionFactory = mock(ClassReflectionFactory::class);
	    $classReflectionFactory->expects('create')->with('\App\Book')->andReturns($reflection = mock(ReflectionClass::class));

	    $reflection->expects('getAttributes')->with('\App\MyAttribute', ReflectionAttribute::IS_INSTANCEOF)->andReturns([]);

        $testSubject = new AttributeResolver($classReflectionFactory, mock(AncestorsResolver::class));
        $result = $testSubject->resolveFirst('\App\Book', '\App\MyAttribute');

        expect($result)->toBeNull();
    });

    it('throws an exception while trying to resolve an attribute for a non existing class', function () {
        $classReflectionFactory = mock(ClassReflectionFactory::class);
        $classReflectionFactory->expects('create')->with('\App\Book')->andThrows(
            new ClassCannotBeReflectedException('Class "\App\Book" does not exist.')
        );

        $testSubject = new AttributeResolver($classReflectionFactory, mock(AncestorsResolver::class));
        $result = $testSubject->resolveFirst('\App\Book', '\App\MyAttribute');
    })->throws(ResolvingException::class, 'Attribute "\App\MyAttribute" cannot be resolved from class "\App\Book"');

    it('returns ancestors attributes', function () {
        $ancestorsResolver = mock(AncestorsResolver::class);
        $ancestorsResolver->expects('resolve')->with('\App\Book')->andReturns([
            '\App\ParentBook',
            '\App\GrandparentBook',
        ]);

        $classReflectionFactory = mock(ClassReflectionFactory::class);
        $classReflectionFactory->expects('create')->with('\App\ParentBook')->andReturns($parentBookClass = mock(ReflectionClass::class));
        $classReflectionFactory->expects('create')->with('\App\GrandparentBook')->andReturns($grandparentBookClass = mock(ReflectionClass::class));

	    $parentBookClass->expects('getAttributes')->with('\App\MyAttribute', ReflectionAttribute::IS_INSTANCEOF)->andReturns([
		    $parentBookClassResourceAttribute = mock(ReflectionAttribute::class),
        ]);

        $parentBookClassResourceAttribute->expects('newInstance')->andReturns($parentBookClassAttributeObject = new stdClass());

	    $grandparentBookClass->expects('getAttributes')->with('\App\MyAttribute', ReflectionAttribute::IS_INSTANCEOF)->andReturns([
		    $grandparentBookClassResourceAttribute = mock(ReflectionAttribute::class),
        ]);

        $grandparentBookClassResourceAttribute->expects('newInstance')->andReturns($grandparentBookClassAttributeObject = new stdClass());

        $testSubject = new AttributeResolver($classReflectionFactory, $ancestorsResolver);
        $result = $testSubject->resolveForAncestors('\App\Book', '\App\MyAttribute');

        expect($result)->toBe([
            $parentBookClassAttributeObject,
            $grandparentBookClassAttributeObject,
        ]);
    });

    it('filters out ancestors without attributes', function () {
        $ancestorsResolver = mock(AncestorsResolver::class);
        $ancestorsResolver->expects('resolve')->with('\App\Book')->andReturns([
            '\App\ParentBook',
            '\App\GrandparentBook',
            '\App\GrandGrandparentBook',
        ]);

        $classReflectionFactory = mock(ClassReflectionFactory::class);
	    $classReflectionFactory->expects('create')->with('\App\ParentBook')->andReturns($parentBookClass = mock(ReflectionClass::class));
	    $classReflectionFactory->expects('create')->with('\App\GrandparentBook')->andReturns($grandparentBookClass = mock(ReflectionClass::class));
	    $classReflectionFactory->expects('create')->with('\App\GrandGrandparentBook')->andReturns($grandGrandparentBookClass = mock(ReflectionClass::class));

	    $parentBookClass->expects('getAttributes')->with('\App\MyAttribute', ReflectionAttribute::IS_INSTANCEOF)->andReturns([
		    $parentBookClassResourceAttribute = mock(ReflectionAttribute::class),
        ]);

        $parentBookClassResourceAttribute->expects('newInstance')->andReturns($parentBookClassAttributeObject = new stdClass());

	    $grandparentBookClass->expects('getAttributes')->with('\App\MyAttribute', ReflectionAttribute::IS_INSTANCEOF)->andReturns([]);

	    $grandGrandparentBookClass->expects('getAttributes')->with('\App\MyAttribute', ReflectionAttribute::IS_INSTANCEOF)->andReturns([
		    $grandGrandparentBookClassResourceAttribute = mock(ReflectionAttribute::class),
        ]);

        $grandGrandparentBookClassResourceAttribute->expects('newInstance')->andReturns($grandGrandparentBookClassAttributeObject = new stdClass());

        $testSubject = new AttributeResolver($classReflectionFactory, $ancestorsResolver);
        $result = $testSubject->resolveForAncestors('\App\Book', '\App\MyAttribute');

        expect($result)->toBe([
            $parentBookClassAttributeObject,
            $grandGrandparentBookClassAttributeObject,
        ]);
    });
});
