<?php

declare(strict_types=1);

namespace Alphpaca\Component\Resource\Action\Context;

use Alphpaca\Contracts\Resource\Action\Context\Context;

class ContextBag implements Context
{
    /**
     * @param array<string, mixed> $context
     */
    public function __construct(
        private array $context = [],
    ) {
    }

    public function add(string $key, mixed $value): void
    {
        $this->context[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->context[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->context);
    }
}
