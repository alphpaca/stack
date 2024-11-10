<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Factory\ObjectFactory;
use Alphpaca\Component\Resource\Filesystem\FileContentProvider;
use Alphpaca\Component\Resource\Filesystem\FileExistenceChecker;
use Alphpaca\Component\Resource\Metadata\Loader\AttributeMetadataLoader;
use Alphpaca\Component\Resource\Metadata\ResourceMetadataFactory;
use Alphpaca\Component\Resource\Parser\Finder\ClassNameFinder;
use Alphpaca\Component\Resource\Parser\PhpParser;
use Alphpaca\Component\Resource\Resolver\AncestorsResolver;
use Alphpaca\Component\Resource\Resolver\AttributeResolver;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use Roave\BetterReflection\BetterReflection;

describe('Attribute Metadata Loader', function () {
    $loader = new AttributeMetadataLoader(
        new FileExistenceChecker(),
        new FileContentProvider(
            new FileExistenceChecker(),
        ),
        new PhpParser(
            (new ParserFactory())->createForNewestSupportedVersion(),
            new NodeTraverser(),
        ),
        new ClassNameFinder(
            new NodeFinder(),
        ),
        new AttributeResolver(
            (new BetterReflection())->reflector(),
            new ObjectFactory(),
            new AncestorsResolver(
                (new BetterReflection())->reflector(),
            ),
        ),
        new ResourceMetadataFactory(),
    );

    it('loads a metadata from a file', function () use ($loader) {
        $metadata = $loader->loadFromFile(__DIR__ . '/DataFixtures/BestsellerBook.php');

        expect($metadata->getName())->toBe('alphpaca_book');
    });

    it('returns null if no `AsResource` attribute is found', function () use ($loader) {
        $metadata = $loader->loadFromFile(__DIR__ . '/DataFixtures/Shelf.php');

        expect($metadata)->toBeNull();
    });
});
