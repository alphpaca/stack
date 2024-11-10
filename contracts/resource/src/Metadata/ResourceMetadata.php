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

namespace Alphpaca\Contracts\Resource\Metadata;

/**
 * A representation of a resource metadata.
 *
 * @since 0.1
 */
interface ResourceMetadata
{
    /**
     * Returns the name of the resource.
     *
     * @since 0.1
     */
    public function getName(): string;

    /**
     * Returns the source of the resource. For example, in case of an Attribute it will return the class name.
     * In case of a config-based sources like a YAML or XML file it will return the path to the file.
     *
     * @since 0.1
     */
    public function getSource(): string;

    /**
     * Returns the type of the source of the resource.
     *
     * @since 0.1
     */
    public function getSourceType(): MetadataSourceType;
}
