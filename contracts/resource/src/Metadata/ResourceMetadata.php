<?php

declare(strict_types=1);

/*
 * This file is part of Eduroo (https://github.com/alphpaca/eduroo).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alphpaca\Contracts\Resource\Metadata;

interface ResourceMetadata
{
    public function getName(): string;
}