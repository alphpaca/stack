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

namespace Alphpaca\Component\Resource\Metadata\Loader;

use Alphpaca\Contracts\Resource\Filesystem\FileContentProvider;
use Alphpaca\Contracts\Resource\Filesystem\FileExistenceChecker;
use Alphpaca\Contracts\Resource\Identity;
use Alphpaca\Contracts\Resource\Metadata\AsResource;
use Alphpaca\Contracts\Resource\Metadata\Loader\Exception\ResourceMetadataLoadingException;
use Alphpaca\Contracts\Resource\Metadata\Loader\ResourceMetadataLoader;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataFactory;
use Alphpaca\Contracts\Resource\Parser\Finder\ClassNameFinder;
use Alphpaca\Contracts\Resource\Parser\PhpParser;
use Alphpaca\Contracts\Resource\Resolver\AttributeResolver;
use Alphpaca\Contracts\Resource\Resource;

final readonly class AttributeMetadataLoader implements ResourceMetadataLoader
{
    public function __construct(
        private FileExistenceChecker $fileExistenceChecker,
        private FileContentProvider $fileContentProvider,
        private PhpParser $phpParser,
        private ClassNameFinder $classNameFinder,
        private AttributeResolver $attributeResolver,
        private ResourceMetadataFactory $resourceMetadataFactory,
    ) {
    }

    public function loadFromFile(string $path): ?ResourceMetadata
    {
        if (!$this->supports($path)) {
            throw new ResourceMetadataLoadingException(sprintf('File "%s" is not supported by this loader.', $path));
        }

        $content = $this->fileContentProvider->provide($path);
        $ast = $this->phpParser->parse($content);
        /** @var class-string<Resource<Identity<int|string>>>|null $className */
        $className = $this->classNameFinder->findFirst($ast);

        if (null === $className) {
            return null;
        }

        $resolvedResourceAttribute = $this->attributeResolver->resolveFirst($className, AsResource::class);

        if (null === $resolvedResourceAttribute) {
            return null;
        }

        return $this->resourceMetadataFactory->createFromAttribute($className, $resolvedResourceAttribute);
    }

    public function supports(string $path): bool
    {
        return $this->fileExistenceChecker->exists($path) && str_ends_with($path, '.php');
    }
}
