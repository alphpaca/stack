<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Metadata\Merger;

use Alphpaca\Contracts\Resource\Metadata\Merger\Exception\ResourceMetadataObjectsMergingException;
use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;

/**
 * A representation of a service responsible for merging two compatible resource metadata objects.
 *
 * @since 0.1
 */
interface Merger
{
	/**
	 * Returns whether two resource metadata objects can be merged.
	 *
	 * @param ResourceMetadata $source the resource metadata object which will be merged
	 * @param ResourceMetadata $target the resource metadata object target of the merging
	 *
	 * @return bool whether the two resource metadata objects can be merged
	 * @since 0.1
	 *
	 */
	public function canBeMerged(ResourceMetadata $source, ResourceMetadata $target): bool;

	/**
	 * Merges two resource metadata objects.
	 *
	 * @param ResourceMetadata $source the resource metadata object which will be merged
	 * @param ResourceMetadata $target the resource metadata object target of the merging
	 *
	 * @return ResourceMetadata resulting merged resource metadata object
	 *
	 * @throws ResourceMetadataObjectsMergingException
	 * @since 0.1
	 *
	 */
	public function merge(ResourceMetadata $source, ResourceMetadata $target): ResourceMetadata;
}
