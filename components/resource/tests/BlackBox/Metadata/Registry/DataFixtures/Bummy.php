<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\BlackBox\Metadata\Registry\DataFixtures;

use Alphpaca\Contracts\Resource\Identity;
use Alphpaca\Contracts\Resource\Resource;

class Bummy implements Resource
{
    public function getIdentity(): Identity
    {
        return new MockIdentifier(1);
    }
}
