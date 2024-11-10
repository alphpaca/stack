<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\Loader\AttributeMetadataLoader;
use Alphpaca\Contracts\Resource\Filesystem\FileContentProvider;
use Alphpaca\Contracts\Resource\Filesystem\FileExistenceChecker;
use Alphpaca\Contracts\Resource\Metadata\AsResource;
use Alphpaca\Contracts\Resource\Metadata\Loader\Exception\ResourceMetadataLoadingException;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataFactory;
use Alphpaca\Contracts\Resource\Parser\Finder\ClassNameFinder;
use Alphpaca\Contracts\Resource\Parser\PhpParser;
use Alphpaca\Contracts\Resource\Resolver\AttributeResolver;

describe('Attribute Metadata Loader', function () {
    it('loads a resource metadata from an attribute', function () {
        $fileExistenceChecker = mock(FileExistenceChecker::class);
        $fileExistenceChecker->expects('exists')->with('/app/Book.php')->andReturn(true);

        $fileContentProvider = mock(FileContentProvider::class);
        $fileContentProvider->expects('provide')->with('/app/Book.php')->andReturn('<?php class Book {}');

        $phpParser = mock(PhpParser::class);
        $phpParser->expects('parse')->with('<?php class Book {}')->andReturn(['stmt']);

        $classNameFinder = mock(ClassNameFinder::class);
        $classNameFinder->expects('findFirst')->with(['stmt'])->andReturn('\App\Book');

        $attributeResolver = mock(AttributeResolver::class);
        $attributeResolver->expects('resolveFirst')->with('\App\Book', AsResource::class)->andReturn($attribute = mock(AsResource::class));

        $resourceMetadataFactory = mock(ResourceMetadataFactory::class);
        $resourceMetadataFactory->expects('createFromAttribute')->with('\App\Book', $attribute)->andReturn($metadata = mock(ResourceMetadata::class));

        $loader = new AttributeMetadataLoader(
            $fileExistenceChecker,
            $fileContentProvider,
            $phpParser,
            $classNameFinder,
            $attributeResolver,
            $resourceMetadataFactory,
        );
        $result = $loader->loadFromFile('/app/Book.php');

        expect($result)->toBe($metadata);
    });

    it('throws an exception if the file is not supported, but it is tried to be loaded', function () {
        $fileExistenceChecker = mock(FileExistenceChecker::class);
        $fileExistenceChecker->expects('exists')->with('/app/Book.php')->andReturn(false);

        $fileContentProvider = mock(FileContentProvider::class);
        $phpParser = mock(PhpParser::class);
        $classNameFinder = mock(ClassNameFinder::class);
        $attributeResolver = mock(AttributeResolver::class);
        $resourceMetadataFactory = mock(ResourceMetadataFactory::class);

        $loader = new AttributeMetadataLoader(
            $fileExistenceChecker,
            $fileContentProvider,
            $phpParser,
            $classNameFinder,
            $attributeResolver,
            $resourceMetadataFactory,
        );
        $loader->loadFromFile('/app/Book.php');
    })->throws(ResourceMetadataLoadingException::class, 'File "/app/Book.php" is not supported by this loader.');

    it('returns null if a file does not contain a class', function () {
        $fileExistenceChecker = mock(FileExistenceChecker::class);
        $fileExistenceChecker->expects('exists')->with('/app/Book.php')->andReturn(true);

        $fileContentProvider = mock(FileContentProvider::class);
        $fileContentProvider->expects('provide')->with('/app/Book.php')->andReturn('<?php class Book {}');

        $phpParser = mock(PhpParser::class);
        $phpParser->expects('parse')->with('<?php class Book {}')->andReturn(['stmt']);

        $classNameFinder = mock(ClassNameFinder::class);
        $classNameFinder->expects('findFirst')->with(['stmt'])->andReturn(null);

        $attributeResolver = mock(AttributeResolver::class);
        $resourceMetadataFactory = mock(ResourceMetadataFactory::class);

        $loader = new AttributeMetadataLoader(
            $fileExistenceChecker,
            $fileContentProvider,
            $phpParser,
            $classNameFinder,
            $attributeResolver,
            $resourceMetadataFactory,
        );
        $result = $loader->loadFromFile('/app/Book.php');

        expect($result)->toBeNull();
    });
});
