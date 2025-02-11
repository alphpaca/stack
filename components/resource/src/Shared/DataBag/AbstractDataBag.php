<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Component\Resource\Shared\DataBag;

abstract class AbstractDataBag
{
	/**
	 * @param array<string, mixed> $input
	 */
	public function __construct(
		private array $input = [],
	)
	{
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
