<?php

declare(strict_types=1);

namespace Alphpaca\Component\Resource\Metadata\Registry;

use Alphpaca\Contracts\Resource\Metadata\Registry\Registry;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;

final class DefaultMetadataRegistry implements Registry
{
    private array $resourceNameToMetadataMap = [];

    private array $resourceClassNameToMetadataMap = [];

    public function add(ResourceMetadata $resourceMetadata): void
    {
        $this->resourceNameToMetadataMap[$resourceMetadata->getName()] = $resourceMetadata;
        $this->resourceClassNameToMetadataMap[$resourceMetadata->getSource()] = $resourceMetadata;
    }
}
