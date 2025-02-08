<?php

declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Parser\Finder;

use Alphpaca\Contracts\Resource\Parser\Finder\ClassNameFinder as ClassNameFinderContract;
use PhpParser\Node\Stmt;
use PhpParser\NodeFinder;

final readonly class ClassNameFinder implements ClassNameFinderContract
{
    public function __construct(
        private NodeFinder $nodeFinder,
    )
    {
    }

    /**
     * @param array<Stmt> $nodes
     */
    public function findFirst(array $nodes): ?string
    {
        $class = $this->nodeFinder->findFirstInstanceOf($nodes, Stmt\Class_::class);

        if (null === $class || null === $class->name) {
            return null;
        }

        /** @var class-string $foundClassName */
        $foundClassName = $class->namespacedName->name ?? implode('\\', [$this->findNamespace($nodes), $class->name->name]);

        return $foundClassName;
    }

    /**
     * @param array<Stmt> $nodes
     */
    private function findNamespace(array $nodes): ?string
    {
        return $this->nodeFinder->findFirstInstanceOf($nodes, Stmt\Namespace_::class)->name->name ?? null;
    }
}
