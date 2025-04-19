<?php declare(strict_types=1);

namespace Alphpaca\Contracts\Resource\Metadata\Registry;

use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataInterface;

interface RegistryInterface
{
    public function add(ResourceMetadataInterface $resourceMetadata): void;

    public function has(string $name): bool;

    public function get(string $name): null|ResourceMetadataInterface;
}