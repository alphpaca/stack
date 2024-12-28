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

namespace Alphpaca\Component\Resource\Metadata;

use Alphpaca\Contracts\Resource\Identity;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata as ResourceMetadataContract;
use Alphpaca\Contracts\Resource\Resource;

readonly class ResourceMetadata implements ResourceMetadataContract
{
    /**
     * @param class-string<Resource<Identity<int|string>>> $class
     */
    public function __construct(
        public string $name,
        public string $source,
        public MetadataSourceType $sourceType,
        public string $class,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getSourceType(): MetadataSourceType
    {
        return $this->sourceType;
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
