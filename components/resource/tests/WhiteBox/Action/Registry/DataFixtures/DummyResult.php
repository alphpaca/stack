<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures;

use Alphpaca\Contracts\Resource\Action\Result;

final readonly class DummyResult implements Result
{
    public function __construct(
        private string $text = 'dummy',
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function isSuccessful(): bool
    {
        return true;
    }
}
