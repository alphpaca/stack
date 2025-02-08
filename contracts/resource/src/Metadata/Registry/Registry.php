<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Metadata\Registry;

use Alphpaca\Contracts\Resource\Metadata\ResourceMetadata;

/**
 * A representation of a resource metadata registry.
 *
 * @since 0.1
 */
interface Registry
{
	/**
	 * Adds a resource metadata to the registry.
	 *
	 * @since 0.1
	 */
	public function add(ResourceMetadata $resourceMetadata): void;

	/**
	 * Returns a resource metadata matching the given name. If no resource metadata is found, returns null.
	 */
	public function getByName(string $name): null|ResourceMetadata;
}
