<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Parser\Finder\ClassNameFinder;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\NodeFinder;

describe('Php Name Finder', function () {
    covers(ClassNameFinder::class);

    it('returns first found class name using namespaced name if present', function () {
        $statements = [
            mock(Stmt::class),
            $classNode = mock(Class_::class),
            mock(Stmt::class),
        ];

        $classNode->name = mock(Identifier::class);
        $classNode->name->name = 'MyClass';
        $classNode->namespacedName = mock(Name::class);
        $classNode->namespacedName->name = 'Namespaced\MyClass';

        $nodeFinder = mock(NodeFinder::class);
        $nodeFinder->expects('findFirstInstanceOf')->with($statements, Class_::class)->andReturns($classNode);

        $testSubject = new ClassNameFinder($nodeFinder);
        $result = $testSubject->findFirst($statements);

        expect($result)->toBe('Namespaced\MyClass');
    });

    it('tries to figure out FQCN on its own once namespaced name is not present', function () {
        $statements = [
            mock(Stmt::class),
            $classNode = mock(Class_::class),
            $namespaceNode = mock(Namespace_::class),
        ];

        $classNode->namespacedName = null;
        $classNode->name = mock(Identifier::class);
        $classNode->name->name = 'MyClass';

        $namespaceNode->name = mock(Name::class);
        $namespaceNode->name->name = 'MySpace';

        $nodeFinder = mock(NodeFinder::class);
        $nodeFinder->expects('findFirstInstanceOf')->with($statements, Class_::class)->andReturns($classNode);
        $nodeFinder->expects('findFirstInstanceOf')->with($statements, Namespace_::class)->andReturns($namespaceNode);

        $testSubject = new ClassNameFinder($nodeFinder);
        $result = $testSubject->findFirst($statements);

        expect($result)->toBe('MySpace\MyClass');
    });

    it('returns null if no class is found', function () {
        $nodeFinder = mock(NodeFinder::class);
        $nodeFinder->expects('findFirstInstanceOf')->with([], Class_::class)->andReturns(null);

        $testSubject = new ClassNameFinder($nodeFinder);
        $result = $testSubject->findFirst([]);

        expect($result)->toBeNull();
    });

    it('returns null if a class is found but has no name', function () {
        $statements = [
            $classNode = mock(Class_::class),
        ];

        $classNode->name = null;

        $nodeFinder = mock(NodeFinder::class);
        $nodeFinder->expects('findFirstInstanceOf')->with($statements, Class_::class)->andReturns($classNode);

        $testSubject = new ClassNameFinder($nodeFinder);
        $result = $testSubject->findFirst($statements);

        expect($result)->toBeNull();
    });
});
