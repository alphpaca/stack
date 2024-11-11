<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\Loader\ExtendableMetadataLoader;
use Alphpaca\Contracts\Resource\Metadata\Loader\ResourceMetadataLoader;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataExtension;

describe('Extendable Metadata Loader', function () {
    covers(ExtendableMetadataLoader::class);

    it('extends loaded metadata', function () {
        $baseLoader = mock(ResourceMetadataLoader::class);
        $baseLoader->expects('loadFromFile')->with('/app/Resource/Book.php')->andReturns($loadedMetadata = mock(ResourceMetadata::class));

        $someExtension = mock(ResourceMetadataExtension::class);
        $someExtension->expects('extend')->once()->with($loadedMetadata);
        $anotherExtension = mock(ResourceMetadataExtension::class);
        $anotherExtension->expects('extend')->once()->with($loadedMetadata);

        $loader = new ExtendableMetadataLoader($baseLoader);
        $loader->addExtension($someExtension);
        $loader->addExtension($anotherExtension);
        $result = $loader->loadFromFile('/app/Resource/Book.php');

        expect($result)->toBe($loadedMetadata);
    });

    it('returns a loaded metadata from the base loader if no extensions are added', function () {
        $baseLoader = mock(ResourceMetadataLoader::class);
        $baseLoader->expects('loadFromFile')->with('/app/Resource/Book.php')->andReturns($loadedMetadata = mock(ResourceMetadata::class));

        $loader = new ExtendableMetadataLoader($baseLoader);
        $result = $loader->loadFromFile('/app/Resource/Book.php');

        expect($result)->toBe($loadedMetadata);
    });

    it('returns null if a loaded metadata is null', function () {
        $baseLoader = mock(ResourceMetadataLoader::class);
        $baseLoader->expects('loadFromFile')->with('/app/Resource/Book.php')->andReturns(null);

        $someExtension = mock(ResourceMetadataExtension::class);
        $someExtension->expects('extend')->never();
        $anotherExtension = mock(ResourceMetadataExtension::class);
        $anotherExtension->expects('extend')->never();

        $loader = new ExtendableMetadataLoader($baseLoader);
        $loader->addExtension($someExtension);
        $loader->addExtension($anotherExtension);
        $result = $loader->loadFromFile('/app/Resource/Book.php');

        expect($result)->toBeNull();
    });
});
