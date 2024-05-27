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
 * Object representation of a resource metadata.
 *
 * @author Jacob Tobiasz <jacob@alphpaca.io>
 *
 * @since 0.1
 */
interface ResourceMetadataInterface
{
    /**
     * Returns the name of the resource.
     *
     * @since 0.1
     */
    public function getName(): string;

    /**
     * Returns the class-string of the resource.
     *
     * @since 0.1
     *
     * @return class-string
     */
    public function getClass(): string;
}
