<?php declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\ResourceMetadata;

describe('Resource Metadata', function () {
    it('returns its name', function () {
        $metadata = new ResourceMetadata('app_name', 'App\Resource\ClassName');

        expect($metadata->getName())->toBe('app_name');
    });

    it('returns its class', function () {
        $metadata = new ResourceMetadata('app_name', 'App\Resource\ClassName');

        expect($metadata->getClass())->toBe('App\Resource\ClassName');
    });
});
