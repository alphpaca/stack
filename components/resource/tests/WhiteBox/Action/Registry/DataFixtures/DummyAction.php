<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures;

use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Context\Context;
use Alphpaca\Contracts\Resource\Action\Input\Input;
use Alphpaca\Contracts\Resource\Action\Result;

final readonly class DummyAction implements Action
{
    public function __construct(
        private ?\Closure $invokeBody = null,
    ) {
    }

    public function __invoke(Input $input, Context $context): Result
    {
        return $this->invokeBody ? ($this->invokeBody)() : new DummyResult();
    }
}
