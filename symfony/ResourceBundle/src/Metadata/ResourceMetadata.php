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

namespace Alphpaca\ResourceBundle\Metadata;

use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataInterface;

readonly class ResourceMetadata implements ResourceMetadataInterface
{
    public function __construct(
        private string $name,
        private string $class,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
