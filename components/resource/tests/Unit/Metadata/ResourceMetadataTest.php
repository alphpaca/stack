<?php declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\Exception\InvalidResourceClassException;
use Tests\Alphpaca\Component\Resource\Unit\Metadata\_Fixture\DummyResource;

describe('Resource Metadata', function () {
    it('throws an exception if the class does not exist', function () {
        new ResourceMetadata('app_dummy', 'NonExistentClass');
    })->throws(
        InvalidResourceClassException::class,
        'Class "NonExistentClass" does not exist.',
    );

    it('throws an exception if the class is not a resource', function () {
        new ResourceMetadata('app_dummy', stdClass::class);
    })->throws(
        InvalidResourceClassException::class,
        'Class "stdClass" must implement the "Alphpaca\Contracts\Resource\Metadata\ResourceInterface" interface to be a valid resource.',
    );

    it('returns its name', function () {
        $metadata = new ResourceMetadata('app_dummy', DummyResource::class);

        expect($metadata->getName())->toBe('app_dummy');
    });

    it('returns its class', function () {
        $metadata = new ResourceMetadata('app_dummy', DummyResource::class);

        expect($metadata->getClass())->toBe(DummyResource::class);
    });
});
