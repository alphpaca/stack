<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\BlackBox\Resolver\DataFixtures;

use Alphpaca\Contracts\Resource\Metadata\AsResource;

#[AsResource(name: 'child_book')]
class ChildBook extends ParentBook
{
}
