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

namespace Alphpaca\Component\Resource\Metadata\Merger;

use Alphpaca\Component\Resource\Metadata\ResourceMetadata;
use Alphpaca\Contracts\Resource\Metadata\Merger\Exception\ResourceMetadataObjectsMergingException;
use Alphpaca\Contracts\Resource\Metadata\Merger\Merger;
use Alphpaca\Contracts\Resource\Metadata\MetadataSourceType;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata as ResourceMetadataContract;

final readonly class DefaultMerger implements Merger
{
    public function canBeMerged(ResourceMetadataContract $source, ResourceMetadataContract $target): bool
    {
        if (!$this->areNamesEqual($source, $target)) {
            return false;
        }

        if (!$this->isAncestor($source, $target)) {
            return false;
        }

        return true;
    }

    private function areNamesEqual(ResourceMetadataContract $source, ResourceMetadataContract $target): bool
    {
        return $source->getName() === $target->getName();
    }

    private function isAncestor(ResourceMetadataContract $source, ResourceMetadataContract $target): bool
    {
        return is_a($target->getClass(), $source->getClass(), true);
    }

    public function merge(ResourceMetadataContract $source, ResourceMetadataContract $target): ResourceMetadataContract
    {
        if (!$this->canBeMerged($source, $target)) {
            throw new ResourceMetadataObjectsMergingException('The provided resource metadata objects are not compatible.');
        }

        return new ResourceMetadata(
            $target->getName(),
            self::class,
            MetadataSourceType::MERGING,
            $target->getClass(),
            $target->getPriority(),
        );
    }
}
