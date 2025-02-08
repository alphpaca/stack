<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Alphpaca\Component\Resource\BlackBox\Metadata\Registry\DataFixtures;

use Alphpaca\Contracts\Resource\Identity;
use Alphpaca\Contracts\Resource\Resource;

class Dummy implements Resource
{
	public function getIdentity(): Identity
	{
		return new MockIdentifier(1);
	}
}
