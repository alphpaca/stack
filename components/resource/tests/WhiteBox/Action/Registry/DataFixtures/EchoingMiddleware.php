<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures;

use Alphpaca\Contracts\Resource\Action\Context\Context;
use Alphpaca\Contracts\Resource\Action\Input\Input;
use Alphpaca\Contracts\Resource\Action\Middleware;
use Alphpaca\Contracts\Resource\Action\Result;

final readonly class EchoingMiddleware implements Middleware
{
    public function __construct(
        private string $text,
    ) {
    }

    public function __invoke(Input $input, Context $context, callable $next): Result
    {
        echo sprintf('Start %s', $this->text) . PHP_EOL;

        $result = $next($input, $context);

        echo sprintf('End %s', $this->text) . PHP_EOL;

        return $result;
    }
}
