<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Alphpaca\Component\Resource\WhiteBox\Action\Registry\DataFixtures;

use Alphpaca\Contracts\Resource\Action\Result;

final readonly class DummyResult implements Result
{
	public function __construct(
		private string $text = 'dummy',
	)
	{
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
