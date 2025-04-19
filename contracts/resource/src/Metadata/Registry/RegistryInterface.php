<?php declare(strict_types=1);

namespace Alphpaca\Contracts\Resource\Metadata\Registry;

use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataInterface;

interface RegistryInterface
{
    /****
 * Adds a resource metadata object to the registry.
 *
 * @param ResourceMetadataInterface $resourceMetadata The resource metadata to register.
 */
public function add(ResourceMetadataInterface $resourceMetadata): void;
}