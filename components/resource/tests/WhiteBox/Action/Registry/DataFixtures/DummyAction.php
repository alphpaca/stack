<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures;

use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Result;

final readonly class DummyAction implements Action
{
    public function __construct(
        private ?string $name = null,
        private ?\Closure $invokeBody = null,
    ) {
    }

    public function __invoke(): Result
    {
        return $this->invokeBody ? ($this->invokeBody)() : new DummyResult();
    }

    public function getName(): string
    {
        return $this->name ?? 'app_dummy_action';
    }
}
