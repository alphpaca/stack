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

namespace Tests\Alphpaca\ResourceBundle\WhiteBox\Metadata;

use Alphpaca\ResourceBundle\Metadata\ResourceMetadata;
use PHPUnit\Framework\TestCase;

final class ResourceMetadataTest extends TestCase
{
    public function testItReturnsItsName(): void
    {
        $metadata = new ResourceMetadata('dummy', '\App\Resource\Dummy');

        $this->assertSame('dummy', $metadata->getName());
    }

    public function testItReturnsItsClass(): void
    {
        $metadata = new ResourceMetadata('dummy', '\App\Resource\Dummy');

        $this->assertSame('\App\Resource\Dummy', $metadata->getClass());
    }
}
