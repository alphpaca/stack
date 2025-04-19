<?php declare(strict_types=1);

namespace Alphpaca\Component\Resource\Metadata\Registry;

use Alphpaca\Contracts\Resource\Metadata\Registry\RegistryInterface;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataInterface;

final class Registry implements RegistryInterface
{
    /** @var array<string, ResourceMetadataInterface> */
    private array $resourcesMetadata = [];

    public function add(ResourceMetadataInterface $resourceMetadata): void
    {
        $this->resourcesMetadata[$resourceMetadata->getName()] = $resourceMetadata;
    }

    public function has(string $name): bool
    {
        return isset($this->resourcesMetadata[$name]);
    }
}