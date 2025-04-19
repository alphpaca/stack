<?php declare(strict_types=1);

namespace Alphpaca\Component\Resource\Metadata\Registry;

use Alphpaca\Contracts\Resource\Metadata\Registry\RegistryInterface;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataInterface;

final class Registry implements RegistryInterface
{
    private array $resourcesMetadata;

    /**
     * Initializes the registry with an empty collection of resource metadata.
     */
    public function __construct()
    {
        $this->resourcesMetadata = [];
    }

    /**
     * Registers a resource metadata object in the registry using its name as the key.
     *
     * @param ResourceMetadataInterface $resourceMetadata The resource metadata to add.
     */
    public function add(ResourceMetadataInterface $resourceMetadata): void
    {
        $this->resourcesMetadata[$resourceMetadata->getName()] = $resourceMetadata;
    }

    /**
     * Determines whether a resource metadata entry exists for the specified name.
     *
     * @param string $name The name of the resource to check.
     * @return bool True if the resource metadata exists; otherwise, false.
     */
    public function has(string $name): bool
    {
        return isset($this->resourcesMetadata[$name]);
    }
}