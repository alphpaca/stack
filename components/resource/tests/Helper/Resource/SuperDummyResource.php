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

use Alphpaca\Contracts\Resource\Metadata\AsResource;

#[AsResource('app_dummy')]
class SuperDummyResource extends DummyResource
{
}
