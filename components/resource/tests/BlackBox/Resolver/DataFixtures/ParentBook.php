<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\BlackBox\Resolver\DataFixtures;

use Alphpaca\Contracts\Resource\Metadata\AsResource;

#[AsResource(name: 'parent_book')]
class ParentBook extends GrandparentBook
{
}
