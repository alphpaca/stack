<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\Helper\Resource;

use Alphpaca\Contracts\Resource\Identity;
use Alphpaca\Contracts\Resource\Metadata\AsResource;
use Alphpaca\Contracts\Resource\Resource;

#[AsResource('app_dummy')]
readonly class DummyResource implements Resource
{
    public function __construct(
        private Identity $identity,
    ) {
    }

    public function getIdentity(): Identity
    {
        return $this->identity;
    }
}
