<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\BlackBox\Metadata\Loader\DataFixtures;

use Alphpaca\Contracts\Resource\Metadata\AsResource;

#[AsResource(name: 'alphpaca_book')]
class BestsellerParentBook extends ParentBook
{
}
