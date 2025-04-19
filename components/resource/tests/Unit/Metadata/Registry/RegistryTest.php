<?php declare(strict_types=1);

use Alphpaca\Component\Resource\Metadata\Registry\Registry;
use Alphpaca\Component\Resource\Metadata\ResourceMetadata;
use Tests\Alphpaca\Component\Resource\Unit\Metadata\_Fixture\DummyResource;

describe('Resources registry', function () {
    it('lets add resources', function () {
        $registry = new Registry();

        expect($registry->has('app_dummy'))->toBeFalse();

        $registry->add(new ResourceMetadata('app_dummy', DummyResource::class));

        expect($registry->has('app_dummy'))->toBeTrue();
    });
});
