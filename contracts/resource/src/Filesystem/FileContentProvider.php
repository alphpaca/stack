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

namespace Alphpaca\Contracts\Resource\Filesystem;

use Alphpaca\Contracts\Resource\Filesystem\Exception\FileCannotBeFoundException;

/**
 * A representation of a service providing a file content.
 *
 * @since v0.1
 */
interface FileContentProvider
{
    /**
     * Returns the content of a given file. If the file cannot be found, an exception will be thrown.
     *
     * @throws FileCannotBeFoundException if the file cannot be found
     *
     * @since v0.1
     */
    public function provide(string $path): string;
}