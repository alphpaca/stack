<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\WhiteBox\Factory\DataFixtures;

final readonly class Book
{
    public function __construct (
        private string $title = 'The Hobbit',
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
