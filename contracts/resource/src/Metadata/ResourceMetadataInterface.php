<?php declare(strict_types=1);

namespace Alphpaca\Contracts\Resource\Metadata;

interface ResourceMetadataInterface
{
    public function getName(): string;

    /**
     * @return class-string<ResourceInterface>
     */
    public function getClass(): string;
}