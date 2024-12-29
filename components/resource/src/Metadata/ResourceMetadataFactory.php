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

use Alphpaca\Contracts\Resource\Metadata\AsResource;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata as ResourceMetadataContract;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataFactory as ResourceMetadataFactoryContract;

final readonly class ResourceMetadataFactory implements ResourceMetadataFactoryContract
{
    public function createFromAttribute(string $className, AsResource $attribute): ResourceMetadataContract
    {
        return new ResourceMetadata(
            name: $attribute->getName(),
            source: $className,
            sourceType: MetadataSourceType::ATTRIBUTE,
            class: $className,
            priority: $attribute->getPriority(),
        );
    }
}
