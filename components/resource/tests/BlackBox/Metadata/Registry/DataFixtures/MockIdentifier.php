<?php

declare(strict_types=1);

namespace Tests\Alphpaca\Component\Resource\BlackBox\Metadata\Registry\DataFixtures;

use Alphpaca\Contracts\Resource\Identity;

readonly class MockIdentifier implements Identity
{
    public function __construct (
        private int $id,
    ) {
    }

    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize(string $data)
    {
        // TODO: Implement unserialize() method.
    }

    public function getValue(): string|int
    {
        return $this->id;
    }

    public function toString(): string
    {
        return (string) $this->id;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function __serialize(): array
    {
        return [];
    }

    public function __unserialize(array $data): void
    {
        // TODO: Implement __unserialize() method.
    }

    public function jsonSerialize(): mixed
    {
        return [];
    }
}
