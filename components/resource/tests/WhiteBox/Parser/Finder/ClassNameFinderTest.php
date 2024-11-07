<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Parser\Finder\ClassNameFinder;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\NodeFinder;

describe('Php Name Finder', function () {
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
});
