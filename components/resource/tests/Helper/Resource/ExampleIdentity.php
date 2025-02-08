<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Alphpaca\Component\Resource\Helper\Resource;

use Alphpaca\Contracts\Resource\Identity;

class ExampleIdentity implements Identity
{
    public function __construct(
        private int $value,
    ) {
    }

    public function serialize(): array
    {
        return [
            'value' => $this->value,
        ];
    }

    public function unserialize(string $data): void
    {
        $unserialized = unserialize($data);
        if (is_array($unserialized) && isset($unserialized['value'])) {
            $this->value = $unserialized['value'];
        }
    }

    public function getValue(): string|int
    {
        return $this->value;
    }

    public function toString(): string
    {
        return (string) $this->value;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function __serialize(): array
    {
        return $this->serialize();
    }

    public function __unserialize(array $data): void
    {
        if (isset($data['value'])) {
            $this->value = $data['value'];
        }
    }

    public function jsonSerialize(): mixed
    {
        return $this->value;
    }
}
