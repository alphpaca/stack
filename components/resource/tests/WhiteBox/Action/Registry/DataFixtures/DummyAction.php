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

use Alphpaca\Contracts\Resource\Action\Action;
use Alphpaca\Contracts\Resource\Action\Context\Context;
use Alphpaca\Contracts\Resource\Action\Input\Input;
use Alphpaca\Contracts\Resource\Action\Result;

final readonly class DummyAction implements Action
{
	public function __construct(
		private null|\Closure $invokeBody = null,
	)
	{
	}

	public function __invoke(Input $input, Context $context): Result
	{
		return $this->invokeBody ? ($this->invokeBody)() : new DummyResult();
	}
}
