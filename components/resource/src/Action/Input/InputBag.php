<?php

declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Action\Input;

use Alphpaca\Contracts\Resource\Action\Input\Input;

class InputBag implements Input
{
    /**
     * @param array<string, mixed> $input
     */
    public function __construct(
        private array $input = [],
    ) {
    }

    public function add(string $key, mixed $value): void
    {
        $this->input[$key] = $value;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->input[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->input);
    }
}
