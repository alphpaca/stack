<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Metadata\Loader;

use Alphpaca\Contracts\Resource\Metadata\ResourceMetadataExtension;

/**
 * Representation of a service loading a resource metadata, with the ability to add extensions.
 *
 * @since 0.1
 */
interface ExtendableResourceMetadataLoader extends ResourceMetadataLoader
{
	/**
	 * Adds a resource metadata extension to the loader.
	 *
	 * The extension will be used to extend the resource metadata once it is loaded.
	 *
	 * @since 0.1
	 */
	public function addExtension(ResourceMetadataExtension $extension): void;
}
