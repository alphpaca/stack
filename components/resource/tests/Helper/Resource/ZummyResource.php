<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\Helper\Resource;

use Alphpaca\Contracts\Resource\Metadata\AsResource;

#[AsResource('app_zummy')]
readonly class ZummyResource extends DummyResource
{
}
