<?php declare(strict_types=1);

namespace Alphpaca\Component\Resource\Metadata;

use Alphpaca\Contracts\Resource\Metadata\ResourceInterface;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataInterface;

final readonly class ResourceMetadata implements ResourceMetadataInterface
{
    /**
     * @param class-string<ResourceInterface> $class
     */
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